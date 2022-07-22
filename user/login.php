<?php
    
    include 'auth.php';
    $data = request();
    try {
         $email = $data->email;
         if(emailval($email)){
         if(isexist($email)){
            $password = parse($data->password);
            if(strlen($password)<8){
                say(203,"Incorrect Email Address or Password");
            }
            else {
                
            }
         }  
         else {
             say(203,"Incorrect Email Address or Password");
         }
        }
        else {
            say(203,"Invalid Email Address");
        }
    }
    catch(Exception $err){
        say(203,"Error Occured");
        logerror($err->getMessage());
    }
?>