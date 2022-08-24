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

    public function getById() {
        $query = 'SELECT r.role as role_name, e.id, e.employee_name, e.email, e.phone, e.address, e.role_id, e.employed_date FROM ' . $this->table . ' e LEFT JOIN roles r ON e.role_id = r.id WHERE e.id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $this->id);     // how to bindValue :id with LEFT JOIN
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->employee_name = $result['employee_name'];
        $this->email = $result['email'];
        $this->phone = $result['phone'];
        $this->address = $result['address'];
        $this->role_id = $result['role_id'];
        $this->role_name = $result['role_name'];
    }
}