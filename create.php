<?php
    try {
    include 'my.php';
    
    $dat = file_get_contents("php://input");
    if(empty($dat)){
        say(203,"Empty Email Address");
    }
    else {
        $data = json_decode($dat);
        $email = parse($data->email);
        if(!emailval($email)){
            throw new Exception("Invalid Email Address");
            exit();
        }
        // $val = json_decode(get_validate($email));
        // var_dump($val);
        // if($val->is_disposable_address==true||$val->result!="deliverable"){
        //     throw new Exception("Invalid Email Address");
        //     exit();
        // }
        $sql= query("SELECT * FROM waitlist WHERE email='$email' ");
        
        if(check($sql)<1){
            $d = now();
            $ins = query("INSERT INTO waitlist(email,waitdate) VALUES('$email','$d') ");
            if($ins){
                $mailtext ="<html>
                            <body>
                            Hello,

                            Welcome to Ordaley Wait List. Each week, you’ll get updates about ordaley and our progress.
                            
                            As a thank you for subscribing, You'll get access to our beta launch early May and also get a discount on our pricing.
                            
                            We’re happy to have you on board. Welcome to the Ordaley family!
                            
                            Feranmi
                            https://ordaley.com
                            </body>
                        </html>
                    ';";
                
                if($mail = mailme($email,$email,'Thank You for Subscribing',$mailtext,'waitlist'))
                {
                    say(200,"Hooray!, you're added to waitlist");
                }
                else {
                    say(203,$mail);
                }
            
            }
            else {
                say(203,"Request Failed");
            }
        }
        else {
            say(203,"You've already been added to waitlist");
        }
        
    }
    }
    catch(Exception $err){
        say(203,$err->getMessage());
    }
    # Consider using the following php curl function.
function get_validate($address) {
    $params = array(
        "address" => $address
    );
    $ch = curl_init();
    // $header = "Authorization": "Basic "+b("api:key-b50a9065a7b9bdf464f3d7a418ca96bb");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:key-a1a7d5b8a5b0c2ca3ce02920f6ef415c');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v4/address/validate');
    $result = curl_exec($ch);
    curl_close($ch);
  
    return $result;
  }
?>