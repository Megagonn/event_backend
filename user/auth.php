<?php

    include '../my.php';
    
    function auth($token){

        

    }
    function createToken($id){
        $token = gen();
        $sql = insertData(["table" => "tokens", "token" => "'$token'", "userid" => "'$id'"]);
        if($sql){
            return $token;
        }
        else {
            return false;
        }

    }
    function login($user){
       $token  = createToken($user['userid']);
        if($token){
            unset($user['userpassword']);
            $obj = new stdClass;
            $obj->user = $user;
            $obj->message =  "Login Successful";
            $obj->token = $token;
            say(200, $obj);
        }
        else {
            say(203,"Signup Failed : ERROR 1012");
        }
    }
    // function 
    function register($email,$name,$password){
        $password = eventhash($password, PASSWORD_DEFAULT);
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
        return $exist ? fetch($sql) : false;
    }
    function eventhash($text){
        return password_hash($text, PASSWORD_DEFAULT);
    }
    function event_compare($string,$hash){
        if (password_verify($string, $hash)) {
            return true;
        } else {
            return false;
        }
    }
?>