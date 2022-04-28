<?php
class Accountinfo extends CI_Model{
    public function Signup(){
        $regfirst=$this->input->post('regfirst');
        $reglast=$this->input->post('reglast');
        $regmobile=$this->input->post('regmobile');
        $regcountry=$this->input->post('regcountry');
        $regemail=$this->input->post('regemail');
        $regemail = str_replace(' ', '', $regemail);
        $regpassword=md5($this->input->post('regpassword')); 

        $msgnumber=substr($regmobile, 1);
        
        $updatedatetime=date('Y-m-d h:i:s');

        $regfullname=$regfirst.' '.$reglast;
        
        $sqlcheckemail="SELECT `idtbl_user` FROM `tbl_user` WHERE `username`=? AND `status`<?";
        $respondcheckemail=$this->db->query($sqlcheckemail, array($regemail, 3));

        if($respondcheckemail->num_rows()==0){
            $sqlcheckmobile="SELECT `idtbl_user` FROM `tbl_user` WHERE `mobile`=? AND `status`<?";
            $respondcheckmobile=$this->db->query($sqlcheckmobile, array($regmobile, 3));

            if($respondcheckmobile->num_rows()==0){
                //User Account Insert
                $datauseraccount = array(
                    'name'=>$regfullname,
                    'username'=>$regemail,
                    'mobile '=>$regmobile,
                    'password'=>$regpassword,
                    'status'=>'0',
                    'insertdatetime'=>$updatedatetime,
                    'tbl_user_type_idtbl_user_type'=>'4'
                );  
                $useraccountinsert=$this->db->insert('tbl_user', $datauseraccount);
                $lastID=$this->db->insert_id();

                //Security Code Insert
                $random=rand(1000,10000);
                $datausercode = array(
                    'usercode'=>$random,
                    'status'=>'1',
                    'tbl_user_idtbl_user'=>$lastID
                );
                $usercodeinsert=$this->db->insert('tbl_user_code', $datausercode);

                $sqlcuscount="SELECT COUNT(*) AS `count` FROM `tbl_customer`";
                $respondcuscount=$this->db->query($sqlcuscount, array());

                $cusregno='LAOL0'.($respondcuscount->row(0)->count+1);

                $regdate=date('Y-m-d');

                //Customer Insert
                $datacustomer = array(
                    'firstname'=>$regfirst,
                    'lastname'=>$reglast,
                    'fullname'=>$regfullname,
                    'phone'=>$regmobile,
                    'email'=>$regemail,
                    'refcode'=>$cusregno,
                    'joindate'=>$regdate,
                    'status'=>'1',
                    'insertuser'=>$lastID,
                    'insertdatetime'=>$updatedatetime,
                    'tbl_country_idtbl_country'=>$regcountry
                );
                $customerinsert=$this->db->insert('tbl_customer', $datacustomer);
                $customerID=$this->db->insert_id();

                //Email Send Security Code
                $link=base_url().'Account/Accountactivate/'.$lastID.'/'.$regfirst.'-'.$reglast;

                if($useraccountinsert && $usercodeinsert && $customerinsert){
                    $message='';
                    $message .= '
                    <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="content-type" content="text/html; charset=utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0;">
                            <meta name="format-detection" content="telephone=no" />
                            <style>
                                body {
                                    margin: 0;
                                    padding: 0;
                                    min-width: 100%;
                                    width: 100% !important;
                                    height: 100% !important;
                                }

                                body,
                                table,
                                td,
                                div,
                                p,
                                a {
                                    -webkit-font-smoothing: antialiased;
                                    text-size-adjust: 100%;
                                    -ms-text-size-adjust: 100%;
                                    -webkit-text-size-adjust: 100%;
                                    line-height: 100%;
                                }

                                table,
                                td {
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    border-collapse: collapse !important;
                                    border-spacing: 0;
                                }

                                img {
                                    border: 0;
                                    line-height: 100%;
                                    outline: none;
                                    text-decoration: none;
                                    -ms-interpolation-mode: bicubic;
                                }

                                #outlook a {
                                    padding: 0;
                                }

                                .ReadMsgBody {
                                    width: 100%;
                                }

                                .ExternalClass {
                                    width: 100%;
                                }

                                .ExternalClass,
                                .ExternalClass p,
                                .ExternalClass span,
                                .ExternalClass font,
                                .ExternalClass td,
                                .ExternalClass div {
                                    line-height: 100%;
                                }
                                @media all and (min-width: 560px) {
                                    .container {
                                        border-radius: 8px;
                                        -webkit-border-radius: 8px;
                                        -moz-border-radius: 8px;
                                        -khtml-border-radius: 8px;
                                    }
                                }
                                a,
                                a:hover {
                                    color: #127DB3;
                                }

                                .footer a,
                                .footer a:hover {
                                    color: #999999;
                                }

                            </style>
                            <title>Herbline Administrator</title>

                        </head>
                        <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
                            background-color: #f2f2f2;
                            color: #000000;" bgcolor="#f2f2f2" text="#000000">
                            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#f2f2f2">
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">   
                                            <tr>
                                                <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 1%; width: 20%; font-size: 26px; font-weight: bold; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                                    <img border="0" vspace="0" hspace="0" src="http://herbline.lk/assets/img/logo/logo.png" width="230" height="60" />
                                                </td>
                                                <td align="right" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-right: 1%; width: 75%; font-size: 14px; font-weight: 300; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                                    Contact us: +94 769 909 992<br>
                                                    Herbline Customer Service
                                                </td>
                                            </tr>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px; margin-top: 20px;" class="container">
                                            <tr>
                                                <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 0%; padding-right: 0%; width: 100%; font-size: 24px; font-weight: 700; line-height: 130%; padding-top: 25px; color: #000000; font-family: Helvetica; " class="header">
                                                    '.$random.' is your one-time PIN for activation.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 14px; font-weight: 300; line-height: 150%; padding-top: 5px; padding-bottom: 25px; color: #000000; font-family: sans-serif;" class="subheader">'.$link.'</td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 14px; font-weight: 300; line-height: 150%; padding-top: 5px; padding-bottom: 25px; color: #000000; font-family: sans-serif;" class="subheader">
                                                    This code is valid for one use only.Please enter the 4-digit code on the web page. If you believe you received this message in error, please contact our support team at +94 769 909 992 right away.
                                                </td>
                                            </tr>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">   
                                            <tr>
                                                <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 1%; width: 90%; font-size: 12px; line-height: 160%; padding-top: 15px; color: #757575; font-family: Helvetica;">
                                                    Please do not reply to this email. Emails sent to this address will not be answered.<br>Copyright © 2020 Herbline (Pvt) Ltd, 63/46/1/1, Dambahena Rd,Maharagama, Sri Lanka. All rights reserved.
                                                </td>
                                                <td align="right" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-right: 1%; width: 10%; font-size: 14px; font-weight: 300; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </body>
                    </html>
                    ';

                    $config['protocol'] = 'sendmail';
                    $config['smtp_host'] = 'localhost';
                    $config['smtp_user'] = '';
                    $config['smtp_pass'] = '';
                    $config['smtp_port'] = 25;

                    $this->email->initialize($config);
                    $this->email->set_mailtype("html"); 
                    $this->email->from('info@laolmart.com', 'Herbline Administrator');
                    $this->email->to($regemail);

                    $this->email->subject('Confermation Code');
                    $this->email->message($message);

                    $this->email->send();

                    redirect(base_url().'Account/Accountactivate/'.$lastID.'/'.$regfirst.'-'.$reglast);
                }
                else{
                    $this->session->set_flashdata('msg', '<i class="w-icon-exclamation-triangle"></i> Please contact our operator');
                    redirect($_SERVER['HTTP_REFERER']);
                }     
            }
            else{
                $this->session->set_flashdata('msg', '<i class="w-icon-call"></i> This mobile already registered Please contact our operator');
                redirect($_SERVER['HTTP_REFERER']);
            }                  
        }
        else{
            $this->session->set_flashdata('msg', '<i class="w-icon-envelop2"></i> This mail already registered Please contact our operator');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function Accountactivatecheck(){
        $securitycode=$this->input->post('securitycode');
        $userid=$this->input->post('userid');

        $updatedatetime=date('Y-m-d h:i:s');
        
        $sql = "SELECT `usercode` FROM `tbl_user_code` WHERE `tbl_user_idtbl_user`=? AND `status`=?";
		$respond=$this->db->query($sql, array($userid, 1));
        $code=$respond->row(0)->usercode;
        
        if($code===$securitycode){
            //User Acoount Activate
            $datauseraccount = array(
                'status'=>'1'
            );  
            $this->db->where('idtbl_user', $userid);
            $useraccountupdate=$this->db->update('tbl_user', $datauseraccount);
            
            //Delete Security Code
            $usercodeupdate=$this->db->delete('tbl_user_code', array('tbl_user_idtbl_user' => $userid));
            
            if($useraccountupdate && $usercodeupdate){
                if($this->cart->total()>0){
                    redirect(base_url().'Cart/Checkout');
                }
                else{
                    redirect('Account/Accountlogin/');
                }
            }
            else{
                $this->session->set_flashdata('msg', 'User Account Not Active, Please contact our agent. Thnak you..');
                redirect('Account/Accountactivate/'.$userid);
            }
        }
        else{
            $this->session->set_flashdata('msg', 'Your security code is incorrect, Please check your email or sms & enter.');
            redirect('Account/Accountactivate/'.$userid);
        }
    }
    public function Accountcheck(){
        $accountemail=$this->input->post('accountemail');

        $updatedatetime=date('Y-m-d h:i:s');
        
        $sql = "SELECT `idtbl_user`, `name` FROM `tbl_user` WHERE `username`=? AND `status`=?";
        $respond=$this->db->query($sql, array($accountemail, 1));
        
        if($respond->num_rows()==0){
            $this->session->set_flashdata('msg', 'Your email address is not registered, Please enter valid email address.');
            redirect('Account/Lostpassword');
        }
        else{
            $accountID=$respond->row(0)->idtbl_user;

            //Security Code Insert
            $random=rand(1000,10000);
            $datausercode = array(
                'usercode'=>$random,
                'status'=>'1',
                'tbl_user_idtbl_user'=>$accountID
            );
            $usercodeinsert=$this->db->insert('tbl_user_code', $datausercode);

            //User Acoount Activate
            $datauseraccount = array(
                'status'=>'2'
            );  
            $this->db->where('idtbl_user', $accountID);
            $useraccountupdate=$this->db->update('tbl_user', $datauseraccount);
            
            $message='';
            $message .= '
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
                    <meta name="format-detection" content="telephone=no" />
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            min-width: 100%;
                            width: 100% !important;
                            height: 100% !important;
                        }

                        body,
                        table,
                        td,
                        div,
                        p,
                        a {
                            -webkit-font-smoothing: antialiased;
                            text-size-adjust: 100%;
                            -ms-text-size-adjust: 100%;
                            -webkit-text-size-adjust: 100%;
                            line-height: 100%;
                        }

                        table,
                        td {
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                            border-collapse: collapse !important;
                            border-spacing: 0;
                        }

                        img {
                            border: 0;
                            line-height: 100%;
                            outline: none;
                            text-decoration: none;
                            -ms-interpolation-mode: bicubic;
                        }

                        #outlook a {
                            padding: 0;
                        }

                        .ReadMsgBody {
                            width: 100%;
                        }

                        .ExternalClass {
                            width: 100%;
                        }

                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;
                        }
                        @media all and (min-width: 560px) {
                            .container {
                                border-radius: 8px;
                                -webkit-border-radius: 8px;
                                -moz-border-radius: 8px;
                                -khtml-border-radius: 8px;
                            }
                        }
                        a,
                        a:hover {
                            color: #127DB3;
                        }

                        .footer a,
                        .footer a:hover {
                            color: #999999;
                        }

                    </style>
                    <title>Herbline Administrator</title>

                </head>
                <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
                    background-color: #f2f2f2;
                    color: #000000;" bgcolor="#f2f2f2" text="#000000">
                    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
                        <tr>
                            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#f2f2f2">
                                <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">   
                                    <tr>
                                        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 1%; width: 20%; font-size: 26px; font-weight: bold; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                            <img border="0" vspace="0" hspace="0" src="http://herbline.lk/assets/img/logo/logo.png" width="230" height="60" />
                                        </td>
                                        <td align="right" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-right: 1%; width: 75%; font-size: 14px; font-weight: 300; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                            Contact us: +94 769 909 992<br>
                                            Herbline Customer Service
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px; margin-top: 20px;" class="container">
                                    <tr>
                                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 0%; padding-right: 0%; width: 100%; font-size: 24px; font-weight: 700; line-height: 130%; padding-top: 25px; color: #000000; font-family: Helvetica; " class="header">
                                            '.$random.' is your one-time PIN for activation.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 14px; font-weight: 300; line-height: 150%; padding-top: 5px; padding-bottom: 25px; color: #000000; font-family: sans-serif;" class="subheader">
                                            This code is valid for one use only.Please enter the 4-digit code on the web page. If you believe you received this message in error, please contact our support team at +94 769 909 992 right away.
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">   
                                    <tr>
                                        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 1%; width: 90%; font-size: 12px; line-height: 160%; padding-top: 15px; color: #757575; font-family: Helvetica;">
                                            Please do not reply to this email. Emails sent to this address will not be answered.<br>Copyright © 2020 Herbline (Pvt) Ltd, 63/46/1/1, Dambahena Rd,Maharagama, Sri Lanka. All rights reserved.
                                        </td>
                                        <td align="right" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-right: 1%; width: 10%; font-size: 14px; font-weight: 300; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>
            ';

            $config['protocol'] = 'sendmail';
            $config['smtp_host'] = 'localhost';
            $config['smtp_user'] = '';
            $config['smtp_pass'] = '';
            $config['smtp_port'] = 25;

            $this->email->initialize($config);
            $this->email->set_mailtype("html"); 
            $this->email->from('info@herbline.lk', 'Herbline Administrator');
            $this->email->to($accountemail);

            $this->email->subject('Confermation Code');
            $this->email->message($message);

            $this->email->send();

            redirect('Account/Changepassword/'.$accountID);
        }
    }
    public function Accountpasswordchange(){
        $securitycode=$this->input->post('securitycode');
        $newpassword=md5($this->input->post('newpassword'));
        $hideaccount=$this->input->post('hideaccount');

        $sql = "SELECT `usercode` FROM `tbl_user_code` WHERE `tbl_user_idtbl_user`=? AND `status`=?";
		$respond=$this->db->query($sql, array($hideaccount, 1));
        $code=$respond->row(0)->usercode;
        
        if($code===$securitycode){
            $datauseraccount = array(
                'password'=>$newpassword,
                'status'=>'1'
            );  
            $this->db->where('idtbl_user', $hideaccount);
            $useraccountupdate=$this->db->update('tbl_user', $datauseraccount);

            //Delete Security Code
            $usercodeupdate=$this->db->delete('tbl_user_code', array('tbl_user_idtbl_user' => $hideaccount));

            if($useraccountupdate){
                redirect('Account/Accountlogin');
            }
            else{
                $this->session->set_flashdata('msg', 'Password not update, Please contact our agent. Thnak you..');
                redirect('Account/Changepassword/'.$hideaccount);
            }
        }
        else{
            $this->session->set_flashdata('msg', 'Your security code is incorrect, Please check your email or sms & enter.');
            redirect('Account/Changepassword/'.$hideaccount);
        }
    }
    public function Loginaccount(){
        $username=$this->input->post('logusername');
        $password=md5($this->input->post('logpassword'));

        $sql="SELECT * FROM `tbl_user` WHERE (`username`=? OR `mobile`=?) AND `password`=? AND `status`=?";
        $respond=$this->db->query($sql, array($username, $username, $password, 1));
    
        if($respond->num_rows()==1){
            $today=date('Y-m-d');
            $time=date('h:i:s');
            $userID=$respond->row(0)->idtbl_user;
            
            return $respond->row(0);
        }
        else{
            return false; 
        }
    }
    public function Countrylist(){
        $this->db->select('idtbl_country, country');
        $this->db->from('tbl_country');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
    public function Citylist(){
        $this->db->select('idtbl_city, city');
        $this->db->from('tbl_city');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
    public function Accountbilladdress(){
        $billadd1=addslashes($this->input->post('billadd1'));
        $billadd2=addslashes($this->input->post('billadd2'));
        $billcity=addslashes($this->input->post('billcity'));
        $billcountry=addslashes($this->input->post('billcountry'));
        $billpost=$this->input->post('billpost');

        $updatedatetime=date('Y-m-d h:i:s');
        
        $userID=$_SESSION['user_id'];

        $this->db->select('idtbl_customer');
        $this->db->from('tbl_customer');
        $this->db->where('insertuser ', $userID);

        $respondcus=$this->db->get();

        $customerID=$respondcus->row(0)->idtbl_customer;

        $this->db->select('COUNT(*) AS count');
        $this->db->from('tbl_customer_address');
        $this->db->where('tbl_customer_idtbl_customer', $customerID);
        $this->db->where('type', 1);
        $this->db->where('status', 1);

        $respondcheck=$this->db->get();

        if($respondcheck->row(0)->count==0){
            $databilladd = array(
                'type'=>'1', 
                'address1'=>$billadd1, 
                'address2'=>$billadd2, 
                'city'=>$billcity, 
                'country'=>$billcountry, 
                'postalcode'=>$billpost, 
                'status'=>'1', 
                'insertuser'=>$userID, 
                'insertdatetime'=>$updatedatetime, 
                'tbl_customer_idtbl_customer'=>$customerID
            );  
            $addbillinsert=$this->db->insert('tbl_customer_address', $databilladd);
        }
        else{
            $databilladd = array(
                'address1'=>$billadd1, 
                'address2'=>$billadd2, 
                'city'=>$billcity, 
                'country'=>$billcountry, 
                'postalcode'=>$billpost, 
                'status'=>'1', 
                'updateuser'=>$userID, 
                'updatedatetime'=>$updatedatetime
            ); 
            $this->db->where('tbl_customer_idtbl_customer', $customerID);
            $this->db->where('type', '1');
            $updatebillupdate=$this->db->update('tbl_customer_address', $databilladd);
        }

        redirect(base_url().'Account/');
    }
    public function Accountshipaddress(){
        $shipadd1=addslashes($this->input->post('shipadd1'));
        $shipadd2=addslashes($this->input->post('shipadd2'));
        $shipcity=addslashes($this->input->post('shipcity'));
        $shipcountry=addslashes($this->input->post('shipcountry'));
        $shippost=$this->input->post('shippost');

        $updatedatetime=date('Y-m-d h:i:s');
        
        $userID=$_SESSION['user_id'];

        $this->db->select('idtbl_customer');
        $this->db->from('tbl_customer');
        $this->db->where('insertuser ', $userID);

        $respondcus=$this->db->get();

        $customerID=$respondcus->row(0)->idtbl_customer;

        $this->db->select('COUNT(*) AS count');
        $this->db->from('tbl_customer_address');
        $this->db->where('tbl_customer_idtbl_customer', $customerID);
        $this->db->where('type', 2);
        $this->db->where('status', 1);

        $respondcheck=$this->db->get();

        if($respondcheck->row(0)->count==0){
            $datashipadd = array(
                'type'=>'2', 
                'address1'=>$shipadd1, 
                'address2'=>$shipadd2, 
                'city'=>$shipcity, 
                'country'=>$shipcountry, 
                'postalcode'=>$shippost, 
                'status'=>'1', 
                'insertuser'=>$userID, 
                'insertdatetime'=>$updatedatetime, 
                'tbl_customer_idtbl_customer'=>$customerID
            );  
            $addshipinsert=$this->db->insert('tbl_customer_address', $datashipadd);
        }
        else{
            $datashipadd = array(
                'address1'=>$shipadd1, 
                'address2'=>$shipadd2, 
                'city'=>$shipcity, 
                'country'=>$shipcountry, 
                'postalcode'=>$shippost, 
                'status'=>'1', 
                'updateuser'=>$userID, 
                'updatedatetime'=>$updatedatetime
            ); 
            $this->db->where('tbl_customer_idtbl_customer', $customerID);
            $this->db->where('type', '2');
            $updateshipupdate=$this->db->update('tbl_customer_address', $datashipadd);
        }

        redirect(base_url().'Account/');
    }
    public function Profileinfo(){
        $profilearray=array();
        if(!empty($_SESSION['user_id'])){
            $userID=$_SESSION['user_id'];

            $this->db->select('*');
            $this->db->from('tbl_customer');
            $this->db->where('status', 1);
            $this->db->where('insertuser ', $userID);

            $respondcusinfo=$this->db->get();

            $customerID=$respondcusinfo->row(0)->idtbl_customer;

            $this->db->select('*');
            $this->db->from('tbl_customer_address');
            $this->db->where('status', 1);
            $this->db->where('type', 1);
            $this->db->where('tbl_customer_idtbl_customer ',  $customerID);

            $respondbillinfo=$this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_customer_address');
            $this->db->where('status', 1);
            $this->db->where('type', 2);
            $this->db->where('tbl_customer_idtbl_customer ',  $customerID);

            $respondshipinfo=$this->db->get();

            $obj=new stdClass();
            $obj->profileinfo=$respondcusinfo->result();
            $obj->billaddress=$respondbillinfo->result();
            $obj->shipaddress=$respondshipinfo->result();
        }
        else{
            $obj=new stdClass();
            $obj->profileinfo='';
            $obj->billaddress='';
            $obj->shipaddress='';
        }

        return $obj;
    }
    public function Profileupdate(){
        $profilefirstname=addslashes($this->input->post('profilefirstname'));
        $profilelastname=addslashes($this->input->post('profilelastname'));

        $regfullname=$profilefirstname.' '.$profilelastname;

        $updatedatetime=date('Y-m-d h:i:s');
        
        $userID=$_SESSION['user_id'];

        $datacustomer = array(
            'firstname'=>$profilefirstname, 
            'lastname'=>$profilelastname, 
            'fullname'=>$regfullname,
            'updateuser'=>$userID, 
            'updatedatetime'=>$updatedatetime
        ); 
        $this->db->where('insertuser', $userID);
        $updatecutomer=$this->db->update('tbl_customer', $datacustomer);

        redirect(base_url().'Account/');
    }
    public function Getotpmsg($x){
        $this->db->select('usercode');
        $this->db->from('tbl_user_code');
        $this->db->where('status', 1);
        $this->db->where('tbl_user_idtbl_user', $x);
        $respondcode=$this->db->get();

        $this->db->select('firstname, lastname, phone');
        $this->db->from('tbl_customer');
        $this->db->where('status', 1);
        $this->db->where('insertuser', $x);
        $respondcusinfo=$this->db->get();

        $link=base_url().'Account/Accountactivate/'.$x.'/'.$respondcusinfo->row(0)->firstname.'-'.$respondcusinfo->row(0)->lastname;

        $msg='Please use this code '.$respondcode->row(0)->usercode.' for activate your account. Click below link '.$link;

        $obj=new stdClass();
        $obj->phone=$msgnumber=substr($respondcusinfo->row(0)->phone, 1);
        $obj->msg=$msg;

        return $obj;
    }
    public function Orderlist(){
        if(!empty($_SESSION['user_id'])){
            $userID=$_SESSION['user_id'];

            $sql="SELECT `idtbl_order`, `orderdate`, `nettotal`, `acceptstatus`, `paystatus`, `shipstatus`, `deliverystatus`, `status` FROM `tbl_order` WHERE `tbl_customer_idtbl_customer` IN (SELECT `idtbl_customer` FROM `tbl_customer` WHERE `insertuser`=?)";
            $respond=$this->db->query($sql, array($userID));

            return $respond;
        }
    }
    public function Orderview(){
        $orderID=addslashes($this->input->post('orderID'));

        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->where('status', 1);
        $this->db->where('idtbl_order', $orderID);

        $respondorder=$this->db->get();

        $this->db->select('*');
        $this->db->from('tbl_order_detail');
        $this->db->where('status', 1);
        $this->db->where('tbl_order_idtbl_order', $orderID);

        $respondorderinfo=$this->db->get();

        $this->db->select('*');
        $this->db->from('tbl_order_delivery');
        $this->db->where('tbl_order_idtbl_order', $orderID);

        $respondorderdelivery=$this->db->get();

        $html='';

        $html.='<div class="row">
					<div class="col-md-6">
						<img src="'.base_url().'images/logo.png" alt="Laol Mart PVT Ltd">
					</div>
					<div class="col-md-6">
						<h5 class="font-weight-normal my-1">LAOL Mart (PVT) Ltd,<br>No.603,<br>Colombo Road,<br>Katunayeka. Sri Lanka</h5>
						<h5 class="my-1">Order No / Date: <span class="font-weight-normal ml-3">PO0'.$respondorder->row(0)->idtbl_order.' / '.date("F j, Y", strtotime($respondorder->row(0)->orderdate)).'</span></h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"><hr></div>
					<div class="col-md-12">
						<table class="shop-table account-orders-table mb-6">
							<thead>
								<tr>
									<th class="order-id">#</th>
									<th class="order-date">Product</th>
									<th class="order-status text-center">Qty</th>
									<th class="order-total text-right">Price</th>
									<th class="order-total text-right">Total</th>
								</tr>
							</thead>
							<tbody>';
                                $i=1;foreach($respondorderinfo->result() as $roworderdetail){
								$html.='<tr>
									<td class="order-id">'.$i.'</td>
									<td class="order-date">'.$roworderdetail->productname.'</td>
									<td class="order-status text-center">'.$roworderdetail->qty.'</td>
									<td class="order-status text-right">'.number_format($roworderdetail->price, 2).'</td>
									<td class="order-total text-right">'.number_format($roworderdetail->total, 2).'</td>
								</tr>';
                                $i++;}
							$html.='</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h5 class="mb-0">'.$respondorderdelivery->row(0)->name.'</h5>
						<h6>'.str_replace(",",",<br>", $respondorderdelivery->row(0)->address).'</h6>
					</div>
					<div class="col-md-6">
						<table class="address-table">
							<tbody>
								<tr>
									<th class="text-right font-size-md">Sub Total</th>
									<td class="text-right font-size-md">Rs. '.number_format($respondorder->row(0)->total, 2).'</td>
								</tr>
								<tr>
									<th class="text-right font-size-md">Ship</th>
									<td class="text-right font-size-md">Rs. '.number_format($respondorder->row(0)->shipcost, 2).'</td>
								</tr>
								<tr>
									<th class="text-right font-size-lg">Net total</th>
									<td class="text-right font-size-lg">Rs. '.number_format($respondorder->row(0)->nettotal, 2).'</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>';
        echo $html;
    }
}