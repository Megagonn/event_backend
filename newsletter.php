<?php
    include 'my.php';
    $email = 'devferanmi@gmail.com';
    $mailtext ='<div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center" class="m_1029548138328032594mdv2rw"><img src="https://ordaley.com/img/logo2.png" width="74" height="24" aria-hidden="true" style="margin-bottom:16px" alt="Google" class="CToWUd"><div style="font-family:\'Google Sans\',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word"><div style="font-size:24px">Weekly Updates</div><table align="center" style="margin-top:8px"><tbody><tr style="line-height:normal"><td align="right" style="padding-right:8px"><img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%" src="https://ordaley.com/img/favicon.png" alt="" class="CToWUd"></td></tr></tbody></table> </div><div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left"><h3>Hi</h3>
        This is Feranmi from Ordaley, and I\'ll be giving you updates from time to time.
        <BR/>Over the past week, We launched our landing page and invited you to subscribe to our newsletter, We\'re so glad you did.<br/>
        Unfortunately, Our email third-party channel failed over the course of five days and we couldn\'t get new email subscribers neither  were we able to send emails..<br/>
        But the goodnews is, We\'re back on and all hands are on desk to fix all loopholes and ensure this doesn\'t happen again.
        We apologise for any inconvenience caused.
        We are fast working on making our launch possible early May.
        <br/>
        <b>Ordaley</b>:<i> Save it, View it!.</i>
    <br/>';
                
    $mail = mailme($email,$email,'Feranmi from Ordaley',$mailtext,'waitlist');
        
    echo $mail;

?>