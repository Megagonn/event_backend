<?php

    include 'query.php';

    function registerUser($name, $email, $password){
        //$sql = insertData(["table"=>"users","username"=>$name, "userpassword"=>$password])   
        $reg = register($email, $name, $password);
        if($reg) {
            say(200, "Registration Successful");
        }
        else {
            say(203, "Registration Faileds");
        }
    }
    function loginUser($email, $password) {
        
        return say(200, "");
    }
?>