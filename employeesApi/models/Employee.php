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

    public function create() {
        $query = 'INSERT INTO ' . $this->table . '(employee_name, email, phone, address, role_id) VALUES (:employee_name, :email, :phone, :address, :role_id)';
        $stmt = $this->conn->prepare($query);
        
        // clean data
        $this->employee_name = htmlspecialchars(strip_tags($this->employee_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->role_id = htmlspecialchars(strip_tags($this->role_id));

        $stmt->bindValue(':employee_name', $this->employee_name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':phone', $this->phone);
        $stmt->bindValue(':address', $this->address);
        $stmt->bindValue(':role_id', $this->role_id);

        if ($stmt->execute()) {     // wont get message if normal execute without elseif
            return true;
        } else {
            return false;
        }
    }
}