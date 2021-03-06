<?php

require_once 'vendor/autoload.php';
 
use Cruder\Sharp\SharpCrud as Cruder;
 $insert_department = array('dept_no' => 'd010', 'dept_name' => 'Test' );
$cruder = Cruder::getInstance('localhost', 'root', '', 'employees');

$query = "SELECT * from employees";

$res = $cruder->raw($query);
print_r($res);exit();
$where = array(
    array('emp_no', '=', 500000),
    array('first_name', '=', 'husnain')
);

//$where = array('emp_no', '=', 500000);
$cruder->table('employees')->where($where);
$cruder->orWhere($where);
$result = $cruder->getAll();

echo "<pre>";
print_r($result);
echo "</pre>";

$update = array(
    array('emp_no', '500001'),
    array('birth_date', '1992-01-22'),
    array('first_name', 'HUSNAIN')
);

$cruder->where(array('hire_date', '=', '2001-04-02'));
$cruder->table('employees');
$res = $cruder->updateCondition($update)->update();

echo "<pre>";
print_r($res);

echo "</pre>";
