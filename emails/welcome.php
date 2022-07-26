<?php
    function welcomemail($token){
        $origin = $_SERVER['SERVER_NAME'];

        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Actionable emails e.g. reset password</title>
        <link href="styles.css" media="all" rel="stylesheet" type="text/css" />
        </head>
        
        <body itemscope itemtype="http://schema.org/EmailMessage">
        
        <table class="body-wrap">
            <tr>
                <td></td>
                <td class="container" width="600">
                    <div class="content">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
                            <tr>
                                <td class="content-wrap">
                                    <meta itemprop="name" content="Confirm Email"/>
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="content-block">
                                                Please confirm your email address by clicking the link below.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block">
                                                We may need to send you critical information about our service and it is important that we have an accurate email address.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
                                                <a href="'.$origin.'/verify?'.$token.'" class="btn-primary" itemprop="url">Confirm email address</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block">
                                                &mdash; The Ordalians
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div class="footer">
                            <table width="100%">
                                <tr>
                                    <td class="aligncenter content-block">Follow <a href="https://twitter.com/Ordaley_app">Ordaley
                            </table>
                        </div></div>
                </td>
                <td></td>
            </tr>
        </table>
        
        </body>
        </html>';
    }
?>