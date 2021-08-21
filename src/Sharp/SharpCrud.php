<?php
namespace Cruder\Sharp;

use Cruder\Sharp\Database;
use Cruder\Sharp\Template;

class SharpCrud extends Database
{
    public $mysqli;
    public $table;
    public $title;
    public $select;

    public $where;
    public $orWhere;
    public  $updateCondition;

    public $limit;
    public $offset;

    public $host;
    public $username;
    public $password;
    public $db;

    public $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!=', '<=>',
        'like', 'like binary', 'not like', 'ilike',
        '&', '|', '^', '<<', '>>', '&~',
        'rlike', 'not rlike', 'regexp', 'not regexp',
        '~', '~*', '!~', '!~*', 'similar to',
        'not similar to', 'not ilike', '~~*', '!~~*',
    ];

    public function __construct($host, $username, $password, $db)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->mysqli = mysqli_connect($this->host, $this->username,$this->password,$this->db);
        // Check connection
        if (!$this->mysqli) {
            return "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
    }

    /**
     * return self instance of this class
     */
    public static function getInstance($localhost, $username, $password, $databasename)
    {
        return new self($localhost, $username, $password, $databasename);
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * @param $table
     * getter and setter of table
     */
    public function table($table) 
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param $select
     * getter and setter of select
     */
    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function where(array $where)
    {
        $this->where = $where;
        return $this;
    }

    public function orWhere(array $orWhere)
    {
        $this->orWhere = $orWhere;
        return $this;
    }

    public function updateCondition(array $updateCondition)
    {
        $this->updateCondition = $updateCondition;
        return $this;
    }

    /**
     * 
     */
    public function getAll()
    {
        if($this->select == '*'){
            $this->select = $this->getColumnNames($this->table);
        }
        if(!$this->select){
            $this->select = $this->getColumnNames($this->table);
        }

        if(!isset($this->limit)){
            $this->limit = NULL;
        }

        if(!isset($this->offset)){
            $this->offset = NULL;
        }

        if(!isset($this->where)){
            $this->where = NULL;
        }

        return $this->getAllByTable($this->mysqli,$this->table, $this->select, $this->limit, $this->offset, $this->where);
    }

    public function insert(array $data)
    {
        return $this->insertRaw($this->mysqli, $this->table, $data);
    }

    public function update()
    {
        return $this->getAllByTable($this->mysqli, $this->table, $this->updateCondition, $this->where);
    }

    public function raw(string $query)
    {
        return $this->rawSelect($query);
    }

    public function render()
    {
        if($this->select == '*'){
            $res = $this->getColumnNames($this->table);
            $this->select = $res;
        }
        if(!$this->select){
            $res = $this->getColumnNames($this->table);
            $this->select = $res;
        }
        
        $data = $this->getAllByTable($this->mysqli,$this->table, $this->select, $this->limit, $this->offset);
        return Template::render($data, $this->select, $this->table, $this->title);
    }

}
