<?php
include 'connect.php';
class Auth{
    public $message = "";
     public function register($username, $password, $conn)
    {
        // Check if username already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $this->message = "Registration failed: username already exists.";
        } else {
            // Proceed with registration
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                $this->message = "Registration successful! Login now.";
            } else {
                $this->message = "Registration failed: username might be taken.";
            }
            $stmt->close();
        }

        $checkStmt->close();
    }

    public function login($username, $password, $conn){
        $cmd = $conn->prepare("SELECT password FROM users WHERE username = ? AND password = ?");
        $cmd->bind_param("ss", $username, $password);
        $cmd->execute();
        $cmd->store_result();

        if($cmd->num_rows > 0){
            $result = $cmd->fetch_assoc();

            if(password_verify($password, $result['password'])){
                $this->message = "Login successful";
                header("location: ../src/pages/dashboard.html");
            }else{
                $this->message = "Incorrect password";
            }
        }else{
            $this->message = "User not found";
        }
        $cmd->close();
    }

    public function logout(){
        
    }

    public function messageAuth(){
        return $this->message;   
    }
}
?>