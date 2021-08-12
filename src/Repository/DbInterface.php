<?php

namespace Cruder\Repository;

interface DbInterface {

    /**
     * Get all results of a given table
     */
    public function getAllByTable($connection, $tablename, $select, $limit, $offset);

    /**
     * Get first result of a given table
     */
    public function getFirstByTable($mysqli, $tablename, $select);

    /**
     * 
     */
    public function getAllByTableWhere($mysqli, $tablename, $where);

    public function insertData($mysqli, $table, array $data);

    public function insertRaw($mysqli,$table, array $query);
}