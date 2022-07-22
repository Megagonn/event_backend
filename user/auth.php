<?php

    include '../my.php';

    function auth($token){

        

    }
    function createToken($id){
        
    }
    function login($email,$password){
        
    }
    // function 
    function register($email,$name,$password){
        $password = ordaleyhash($password);
        $sql = query("INSERT INTO users(useremail,username,userpassword) VALUES('$email','$name','$password')");
        if($sql){
            if(isexist($email)){
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    function isexist($email){
        $sql = query("SELECT * FROM users WHERE useremail='$email' ");
        $exist = check($sql);
        return $exist;
    }
    function ordaleyhash($text){
        return password_hash($text);
    }
?>