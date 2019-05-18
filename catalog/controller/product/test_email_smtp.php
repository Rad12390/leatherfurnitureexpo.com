<?php

/*
  #file: catalog/controller/product/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
  #switched: v1.5.4.1 - v1.5.5.1
 */

class ControllerProductTestemailsmtp extends Controller {

    private $error = array();

    public function test_email_smtp() {
        
                        $_POST['Collection'] = "Alexandria";

                        $_POST['first_name'] = 'sumit';
                        $_POST['last_name'] = 'parkash';
                        $_POST['address1'] = "kanrnla";
                        $_POST['address2'] = "chkdsf";
                        $_POST['city'] = "miami";
                        $_POST['state'] = "florida";
                        $_POST['zip'] = "16022";
                        $_POST['country'] = "USA";
                        $_POST['phone'] = "1234567890";
                        $email = "sumit.intersoft@gmail.com";

                        $email_to = $email;
                        $mail = new Mail();

                        //Body Message
                        $customer_message = "Hello ".$_POST["First_Name"]."<br /><br />
                        Thank you for your swatch request for the ".$_POST['Collection']." collection on leatherfurnitureexpo.com.<br /><br />
                        Your request will be shipped within the next business day. To view more furniture collections or request more swatches visit <a href=\"http://www.leatherfurnitureexpo.com\" target=\"_blank\"> http://www.leatherfurnitureexpo.com</a><br>
                        Leather Furniture Expo<br /><h3>Call Toll Free: 1-800-737-7702</h3><p><strong>Our Privacy Policy:</strong> We will never sell or share your information with anyone. Ever<br /><br /> Thanks <br/> Leather Furniture Expo Team";


                        $mail->protocol =   'smtp';  // $this->config->get('config_mail_protocol'); 
                        $mail->parameter = $this->config->get('config_mail_parameter');
                        $mail->hostname =    "mail.powermailserver.net" ;// $this->config->get('config_smtp_host');
                        $mail->username = $this->config->get('config_smtp_username');
                        $mail->password = $this->config->get('config_smtp_password');
                        $mail->port =     25 ; //$this->config->get('config_smtp_port');
                        $mail->timeout =$this->config->get('config_smtp_timeout');
                        $mail->setTo($email_to);
                        $mail->setFrom($this->config->get('config_email'));
                        $mail->setSender("Leather Furniture Expo");
                        $mail->setSubject("Swatch Request Confirmation");
                        $mail->setHtml($customer_message);
                        
                        $mail->test_email_smtp_send();

            echo  ' this is test ';
        
    }

}

?>
 
           