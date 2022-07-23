<?php
ini_set('display_errors',true);
if($_SERVER['SERVER_NAME']=='ordaley.herokuapp.com'){
ini_set('display_errors',true);
}
cors();
header('Access-Control-Allow-Headers: X-Requested-With, privatekey');
function cors() {
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
    
    // echo "You have CORS!";
}
    if($_SERVER['SERVER_NAME']=='phalconwise.herokuapp.com'){
        ini_set('display_errors',false);
    }
    if(isset($_SERVER['HTTP_ORIGIN'])){

        $origin = $_SERVER['HTTP_ORIGIN'];
    }
    else {
        $origin = '*';
    }
    // echo $origin;
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin:*");
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
    include 'dbh.php';
    include 'mailer.php';
   // ini_set("display_errors",0);
    $timezone_string = 'Africa/Lagos';
date_default_timezone_set($timezone_string);
function parse($el){
    include 'dbh.php';
    $newel = str_replace("/", "", $el);
    return mysqli_real_escape_string($conn,$newel);
}
function i($d,$e){
    return parse($d->$e);
}
function isLocal(){
    if($_SERVER['SERVER_NAME'] == "localhost") {
        return true;
    }
    return false;
}
function request(){
    $dat = file_get_contents("php://input");
    if(empty($dat)){
        say(403,"Empty Request");
    }
    else {
        try {
            return json_decode($dat);
        }
        catch(Exception $err){
            say(400,"Unknown Error");
        }
    }

}
function valname($name){
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          say(203,$name." contains non-alphabetic characters");
        }
        else {
            return $name;
        }
}
function val($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return parse($data);
}
function notify($notification,$showto,$type){

    $date = now();
    if(!isset($type)){
        $type = 0;
    }
    $sql = query("INSERT INTO notifications(note,notefor,notedate,notetype) VALUES('$notification','$showto','$date','$type')");
    if(!$sql){
        echo 'bad';
        return false;
    }
    else {
        $updatecount = query("UPDATE users SET notecount=notecount+1 WHERE userid='$showto' ");
        return true;
    }
}
    
    function subscribe($email,$name){
        $date = now();
            $message = '<html>
         <body>
            <img src="https://medcord.netlify.app/img/logo.png" width=50px height=50px/>
            <h2>Hi '.$name.'</h2>
             
              
              <br/>
             Welcome to MedCord <br>
             We want to thank you for signing up for our newsletter on MedCord.
             We\'ll give you all exciting and insighting updates from time to time,
             You can also unsubscribe to our  newsletter when you want to.

             Thank You.<br>
             <b>The MedCord Team.</b>

              <footer>
              
               <i>&copy; 2020 MedCord Inc</i>
              </footer>
            </body>
      </html>';


      $smail = query("SELECT * FROM `subs` WHERE subemail = '$email' ");
      $c = mysqli_num_rows($smail);
      if($c!=0){
        // say(203,"Email Already subscribed");
        // exit();
        // die();
      }
      else {
        $mail = mailme($email,$name,"Welcome to MedCord",$message, "type");
        if($mail){
            $mail = mailme($email,$name,"Welcome to MedCord",$message,"type");
            if($mail){
                //failedmails($message,$email);
                logerror($mail);
            }
        }
        $sql = query("INSERT INTO subs(subemail,subname,subtimest) VALUES('$email','$name','$date')");
        say(200,"Email Saved Successfully");
     }
    }

function logerror($error){
    $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $logtime = now();
    $sql = query("INSERT INTO logs(logtext,logdate,logurl) VALUES('$error','$logtime','$url')");
    if($sql){
        return true;
    }
    else {
        return false;
    }
}
function savetoken($token,$userid){
    deleteUserTokens($userid);
    $expiry = expiry();
    $i = 1;
    $sql = query("INSERT INTO tokens(token,tokenexpiry,userid) VALUES('$token','$expiry','$userid') ");
    if(!$sql){
        return 500;
    }
    else {
        return 200;
    }
}
function numberexist($number){
   
    if(valnumber($number)){
        $sql = query("SELECT * FROM users WHERE userphonenumber='$number' ");
        if(check($sql)<1){
            return false;
        }
        else {
            return true;
        }
    }
    else {
        say(203,"Invalid Phone Number");
    }
}
function usernamexist($username){
    $checkusername = query("SELECT * FROM users WHERE username='$username' ");
                if(check($checkusername)>0){
                   return false;
                }
                else {
                    return true;
                }
}
function finduser($username){
    if(val($username)){
        $name = val($username);
        $sql = query("SELECT userid,username,useremail,notecount,verified,userphonenumber FROM users WHERE username='$name' OR userid='$username' OR useremail='$username' ");
        if(check($sql)>0){
            $row = fetch($sql);
            return $row;
        }
        else {
            say(203,"Invalid Login");
        }
    }
}
function finduserbytoken($token){
    $sql = query("SELECT * FROM tokens WHERE token='$token' ");
    if(check($sql)>0){
        $row = fetch($sql);
        return finduser($row['userid']);
    }
    else {
        say(403,"Login");
        return false;
    }
}
function emailexist($email){
    $email = val($email);
    if(emailval($email)){
        $sql = query("SELECT * FROM users WHERE useremail='$email' ");
        if(check($sql)<1){
            //not registered
           return false;
        }
        else {
            //registered 
            return true;
        }
    }
    else {
        say(203,"Invalid Email Address");
    }
}
function deletetoken($token){
    $sql = query("DELETE FROM tokens WHERE token='$token' ");
    if(!$sql){
        return 500;
    }
    else {
        return 200;
    }
}
function deleteUserTokens($userid){
    $sql = query("DELETE FROM tokens WHERE userid='$userid' ");
}
function verifytoken($token){
    $sql = query("SELECT * FROM tokens WHERE token='$token' ");
    $ans = new stdclass;
    if(check($sql)==0){
        $ans->type = false;
    }
    else {
        $row = fetch($sql);
        $userid = $row['userid'];
        $ans->type = true;
        $ans->userid = $userid;
    }
    return $ans;
}

function post($el){
    return parse($_POST[$el]);
}
function get($el){
    return $_GET[$el];

}
function query($el){
    include 'dbh.php';
    //var_dump($el);
    return mysqli_query($conn,$el);

}
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
    }
    /**
    * get access token from header
    * */
    function getBearerToken() {
    $headers = getAuthorizationHeader();
    // echo $headers;
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        
            return $headers;
        
    }
    return null;
}

function authProtected(){
    $token = getBearerToken();
    // echo $token;
    // say(200,$token);
    if($token){
        return $token;
    }
    else {
        say(403,"Access Denied to this resource, Please login");
    }

}
function getBearer(){
    $bearertoken = authProtected();
    return $bearertoken;
}
function fetch($el){
    return mysqli_fetch_assoc($el);
}
function check($el){
    return mysqli_num_rows($el);
}
function allowedMethod($allowed){
    $method = $_SERVER['REQUEST_METHOD'];
    if($method!=$allowed){
        say(403,"Access Denied");
    }
}
function emailval($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       return false;
    }
    else {
        return true;
    }
}
function valnumber($number){
    if (!filter_var($number, FILTER_VALIDATE_INT)) {
        return false;
     }
     else {
         return true;
     }
}
function calctime($el){
    $time = $el;
    $arr = explode(".",$time);
    $day = date("d");
    $month = date("m");
    $year = date("y");
    $minute = date("");
}

function gen(){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $jwt = substr(str_shuffle($permitted_chars), 0, 50);
            return $jwt;
}
function now(){
  $exp = date('H');
  $date = date('i-d/m/Y');
  $r = $exp.":".$date;
  return $r;
}
function expiry(){
    $exp = date('H')+1;
  $date = date('i-d/m/Y');
  $r = $exp.":".$date;
  return $r;
}

 function say($code,$msg){
        $m = new stdclass;
        $m->code = $code;
        $m->response = $msg;
        $m->date = now();
        echo trim(json_encode($m));
        die();
        return false;
        exit();
     }
?>