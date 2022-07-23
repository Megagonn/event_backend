<?php
    include 'auth.php';
    include '../queries/index.php';
    
    $data = request();
    try {
         $email = $data->email;
         if(emailval($email)){
         if($user = isexist($email)){
            $password = parse($data->password);
            if(strlen($password)<8){
                say(203,"Incorrect Email Address or Password");
            }
            else {
                $correctHash =  $user['userpassword'];
                if(event_compare($password, $correctHash)){
                    return login($user);   
                }
                else {
                    say(203,"Incorrect Email Address or Password");   
                }
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