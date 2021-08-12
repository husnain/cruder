<?php

require_once 'vendor/autoload.php';
 
use Cruder\Sharp\SharpCrud as Cruder;
 $insert_department = array('dept_no' => 'd010', 'dept_name' => 'Test' );
$cruder = Cruder::getInstance('localhost', 'root', '', 'employees');


$cruder->table('employees');
$result = $cruder->getAll();
//print_r($result);
