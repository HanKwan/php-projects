<?php 

class Employee {
    private $conn;
    private $table = 'employees';

    public $id;
    public $employee_name;
    public $email;
    public $phone;
    public $address;
    public $role_id;
    public $role_name;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = 'SELECT r.role as role_name, e.id, e.employee_name, e.email, e.phone, e.address, e.role_id, e.employed_date FROM ' . $this->table . ' e LEFT JOIN roles r ON e.role_id = r.id ORDER BY e.employed_date DESC';
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}