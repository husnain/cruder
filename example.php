<?php

require_once 'vendor/autoload.php';
 
use Cruder\Sharp\SharpCrud as Cruder;
 $insert_department = array('dept_no' => 'd010', 'dept_name' => 'Test' );
$cruder = Cruder::getInstance('localhost', 'root', '', 'employees');


$cruder->table('employees')->where(array('emp_no', '=', 500000));

$result = $cruder->getAll();
echo "<pre>";
print_r($result);
