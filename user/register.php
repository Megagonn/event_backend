<?php
    include 'auth.php';
    include '../queries/index.php';


    allowedMethod("POST");
    $data = request();
    try {
        $email = parse($data->email);
        $name = parse($data->name);
        $password = parse($data->password);
        if(emailval($email)){
            if(strlen($password)<8){
                say(203,"Password must be eight{8) characters or more");
            }
            else {
                if(strlen($name)<4){
                    say(203,"Username must be more than 3 characters");
                }
                else if(emailexist($email)){
                   return say(203, "Email already exists");
                }
                else {
                    //register 
                    return registerUser($name, $email, $password);
                }   
            }
        }
        else {
            say(203,"Invalid Email Address");
        }
    }
    catch(Exception $err){
        say(203,"Error Occured");
    }
?>