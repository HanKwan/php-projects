<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Header: Access-Control-Allow-Header, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->connect();

$employee = new Employee($db);
$data = json_decode(file_get_contents("php://input"));

$employee->employee_name = $data->employee_name;
$employee->email = $data->email;
$employee->phone = $data->phone;
$employee->address = $data->address;
$employee->role_id = $data->role_id;

if ($employee->create()) {
    echo json_encode(array( 'message' => 'employee added' ));
} else {
    echo json_encode(array( 'message' => 'employee not added' ));
}