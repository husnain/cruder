<?php

require_once 'vendor/autoload.php';
 
use Cruder\Sharp\SharpCrud as Cruder;
 $insert_department = array('dept_no' => 'd010', 'dept_name' => 'Test' );
$cruder = Cruder::getInstance('localhost', 'root', '', 'employees');

echo "<pre>";
// $select = array('emp_no', 'dept_no');
//$cruder->table('employees');
$cruder->table('employees');
//$result = $cruder->getAll();
//print_r($result);
// $cruder->select($select);
//$cruder->title('Hello Robert');
//$cruder->limit(50);
$insert = array('emp_no' => '500000', 'birth_date' => '1992-01-21', 'first_name'=> "husnain", "last_name" => 'ahmed', 'gender' => 'M', 'hire_date' => '2001-04-02');
//$insert = $cruder->insert($insert_department);
// $cruder->offset(1);
//$data = $cruder->render();
//$query = "INSERT INTO `departments` (`dept_no`, `dept_name`) VALUES ('a004', 'Testing19');";
$insert_return = $cruder->insert($insert);
//echo "<pre>";
print_r($insert_return);


