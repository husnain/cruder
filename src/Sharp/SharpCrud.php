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

    public $limit;
    public $offset;

    public function __construct()
    {
        $this->mysqli = mysqli_connect('localhost', 'root','','employees');
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
        return $this->getAllByTable($this->mysqli,$this->table, $this->select, $this->limit, $this->offset);
    }

    public function insert(array $data)
    {
        return $this->insertRaw($this->mysqli, $this->table, $data);
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
