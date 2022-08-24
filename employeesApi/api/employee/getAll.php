<?php

header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Method: GET');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Employee.php';

$database = new Database();
$db = $database->connect();

$employee = new Employee($db);
$stmt = $employee->getAll();
$count = $stmt->rowCount();

if ($count > 0) {
    $employeeArr = [];
    $employeeArr['data'] = [];

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($result);

        $item = [
            'id' => $id,
            'employee_name' => $employee_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'role_id' => $role_id,
            'role_name' => $role_name,
        ];

        array_push($employeeArr['data'], $item);
    }

    echo json_encode($employeeArr);
} else {
    echo json_encode(array( 'message' => 'There is no post' ));
}