<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Header: Access-Control-Allow-Method, Content-Type, Access-Control-Allow-Header, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->connect();

$emp = new Employee($db);
$data = json_decode(file_get_contents('php://input'));

$emp->id = $data->id;
$emp->employee_name = $data->employee_name;
$emp->email = $data->email;
$emp->phone = $data->phone;
$emp->address = $data->address;
$emp->role_id = $data->role_id;

if ($emp->update()) {
    echo json_encode(array( 'message' => 'employee updated' ));
} else {
    echo json_encode(array( 'message' => 'employee not updated' ));
}