<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applicaion/json');
header('Access-Contorl-Allow-Method: DELETE');
header('Access-Contorl-Allow-Header: Access-Contorl-Allow-Header, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->connect();

$employee = new Employee($db);
$data = json_decode(file_get_contents('php://input'));

$employee->id = $data->id;

if ($employee->delete()) {
    echo json_encode(array( 'message' => 'employee deleted' ));
} else {
    echo json_encode(array( 'message' => 'employee not deleted' ));
}