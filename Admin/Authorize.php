<?php
session_start();

class Authorize{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // FUNCTIONS
    public function register($Username, $Password, $Fullname){
        $query = "SELECT * FROM admin WHERE Username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $Username);
        

        if($stmt->execute()){

            $result = $stmt->get_result();
            if($result->num_rows > 0){

                return false; // Username already exists
            }

        }else{
            
            return "Error executing query to check username.";
        }
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

        $query = "INSERT INTO admin (Username, Password, Fullname, created_at) VALUES (?, ?, ?, NOW()))";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $Username, $hashedPassword, $Fullname);

        if($stmt->execute()){
            return "Registration Successful"; // Registration successful
    }else{
        return "Error registering user.";
    }
}
    public function login(){


}
public function logout(){
    session_destroy();
}
}

?>