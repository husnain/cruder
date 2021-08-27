<?php

namespace Cruder\Sharp;

use Cruder\DotEnv;
use Cruder\Repository\DbInterface;

class Database implements DbInterface
{

    protected $db;
    protected $host;
    protected $port;
    protected $user;
    protected $password;

    /**
     * Constructor
     */
    public function __construct()
    {}


    /**
     * @return mixed
     */
    public function getAllByTable($connection, $table, $select, $limit, $offset, $where)
    {
        $result = "";
        if($select != '*'){
            $select = $this->arraySelectToString($select);
        }
        if($limit != NULL){
            $limit = 'LIMIT ' . $limit;
        }

        if($offset != NULL){
            $offset = 'OFFSET ' . $offset;
        }


        if($where != NULL){
            if(count($where) == count($where, COUNT_RECURSIVE)){
                $where = implode($where);
                $where_clause = 'WHERE '. $where;
            }else{
                $i = 0;
                foreach ($where as $value){
                    if($i > 0){
                        $result .= ' AND '.implode($value);
                    }else{
                        $result .= implode($value);
                    }
                    $i++;
                }
                $where_clause = 'WHERE '.$result;
            }
        }else{
            $where_clause = "";
        }

        if($this->orWhere != NULL){
            if(count($this->orWhere) == count($this->orWhere, COUNT_RECURSIVE)){
                $this->orWhere = implode($this->orWhere);
                $or_where_clause = 'WHERE '. $this->orWhere;
            }else{
                $i = 0;
                foreach ($where as $value){
//                    if($i > 0){
                        $result .= ' OR '.implode($value);
//                    }else{
//                        $result .= implode($value);
//                    }
//                    $i++;
                }
                $or_where_clause = 'WHERE '.$result;
            }
        }

        // return $or_where_clause;

        // return $where_clause;
        $sql = "SELECT $select FROM $table $where_clause $limit $offset";
        $result = $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    /**
     * @param $array
     * @return $string
     */
    protected function arraySelectToString($array)
    {
        return implode(",", $array);
    }

    /**
     * @param $dbString
     * @return mixed
     */
    protected function DbStringToArray($dbString)
    {
        return $dbString->free_result();
    }

    /**
     * @param $table
     * @param $where
     * @return $result
     */
    public function getAllByTableWhere($mysqli, $table, $where)
    {
        $sql = "SELECT * FROM $table WHERE $where";
        $result = $this->mysqli->query($sql);
        return $result;
    }

    public function rawSelect($query)
    {
        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param $tablename
     * @param $select
     * @return NULL|\mysqli_result
     */
    public function getFirstByTable($mysqli, $tablename, $select)
    {
        return NULL;
    }


    public function getColumnNames($table)
    {
        $sql = "SHOW COLUMNS FROM $table";
        $columns = array();
        $result = $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
        foreach($result as $column){
            array_push($columns, $column['Field']);
        }
        return $columns;
    }


    public function insertRaw($mysqli, $table, array $data)
    {
        $columns = implode(",", array_keys($data));
        $values = implode("','",array_values($data));

        $query = "INSERT INTO `$table`($columns) VALUES ('$values')";

        try {
            if ($mysqli->query($query) === TRUE) {
                return $mysqli->insert_id;
            } else {
                return "Error: " . $query . "<br>" . $mysqli->error;
            }

        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function insertData($mysqli, $table, array $data){
        return NULL;
    }

    public function updateQuery($mysqli, $table, $update_condition, $where)
    {
//        $update = implode(",",$update_condition);
        return $update_condition;
        $query = "UPDATE $table SET $update_condition $where";
        return $query;
    }

}
