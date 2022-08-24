<?php

header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Method: GET');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->connect();

$employee = new Employee($db);
$employee->id = $_GET['id'] ?? die();
$employee->getById();  

$empArr = [
    'id' => $employee->id,
    'employee_name' => $employee->employee_name,
    'email' => $employee->email,
    'phone' => $employee->phone,
    'address' => $employee->address,
    'role_id' => $employee->role_id,
    'role_name' => $employee->role_name,
];

echo json_encode($empArr);