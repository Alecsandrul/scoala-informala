<?php

class Login {
    function index() {
        
        $errors = array();
        if (isset($_POST["email"])) {
            if (empty($_POST["email"])) {
                $errors["email"] = "Email is required";    
            }
            elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  {
                $errors["email"] = "Email is invalid";
            }
            
            $patternPassword = '/^[a-z0-9$#_]{5,15}$/i';
            if (empty($_POST["password"])) {
                $errors["password"] = "Password is required";    
            }
           elseif (!preg_match($patternPassword,$_POST["password"])) {
                $errors["password"] = "Password is invalid";    
           }
            
            if (empty($errors)) {
                require "app/models/UsersModel.php";
                $usersModel = new UsersModel();
                $user = $usersModel->loginUser($_POST["email"]);
                
                if ($user === FALSE) {
                    $errors["invalid"] = "Invalid credentials";
                }
                else {
                    $_SESSION["isLogged"] = TRUE;
                    $_SESSION["user"] = $user;
                    return $user;
                }
            }
        }
        else {
            $errors["invalid"] = "Request invalid"; 
        }
        
        return array("errors" => $errors);
    }
    
    function logout() {
        unset($_SESSION["isLogged"]);
         unset($_SESSION["user"]);
        session_destroy();
         
        return array("success"=>TRUE);
    }
    
    function checkSession() {
        if (isset($_SESSION["isLogged"]) && ($_SESSION["isLogged"] == TRUE)) {
            return array("logged"=>TRUE, "user" => $_SESSION["user"]);    
        } 
        else {
            return array("logged"=>FALSE);  
        }
    }
}