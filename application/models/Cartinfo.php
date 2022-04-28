<?php
class Cartinfo extends CI_Model{
    public function Citylist(){
        $this->db->select('idtbl_city, city');
        $this->db->from('tbl_city');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
    public function Checkpayment(){
        if(isset($_SESSION['user_id'])){
            $loguser=$_SESSION['user_id'];
            $outstockstatus=0;

            $orderdate=date('Y-m-d');
            $discount=0;
            $updatedatetime=date('Y-m-d h:i:s');
            $productemaillist=array();
            
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $streetaddress1=$this->input->post('streetaddress1');
            $streetaddress2=$this->input->post('streetaddress2');
            $city=$this->input->post('town');
            $email=$this->input->post('email');
            $zipcode=$this->input->post('zipcode');
            $phone=$this->input->post('phone');
            
            $firstnamedrop=$this->input->post('firstnamedrop');
            $lastnamedrop=$this->input->post('lastnamedrop');
            $streetaddress1drop=$this->input->post('streetaddress1drop');
            $streetaddress2drop=$this->input->post('streetaddress2drop');
            $citydrop=$this->input->post('citydrop');
            $postcodedrop=$this->input->post('postcodedrop');
            
            $ordernotes=$this->input->post('ordernotes');
            $paymenttype=$this->input->post('paymenttype');
            $shipcost=$this->input->post('shipcoast');

            $sqlcustomer="SELECT * FROM `tbl_customer` WHERE `insertuser`=? AND `status`=?";
            $respondcustomer=$this->db->query($sqlcustomer, array($loguser, 1));

            $customerID=$respondcustomer->row(0)->idtbl_customer;

            if($firstnamedrop=='' && $lastnamedrop=='' && $streetaddress1drop=='' && $streetaddress2drop=='' && $citydrop==''){
                $deliveryname=$firstname.' '.$lastname;
                $deliverymobile=$phone;
                $deliverymobile2='';
                $deliveryaddressone=$streetaddress1.' '.$streetaddress2.' '.$city;
                $deliveryaddresstwo='';
                $deliverycity=$city;
                $otherdeliverystatus=0;

                $this->db->select('COUNT(*) AS count');
                $this->db->from('tbl_customer_address');
                $this->db->where('status', 1);
                $this->db->where('type', 2);
                $this->db->where('tbl_customer_idtbl_customer ',  $customerID);

                $respondshipinfo=$this->db->get();

                if($respondshipinfo->row(0)->count==0){
                    $datashipadd = array(
                        'type'=>'2', 
                        'address1'=>$streetaddress1, 
                        'address2'=>$streetaddress2, 
                        'city'=>$city, 
                        'country'=>'', 
                        'postalcode'=>$zipcode, 
                        'status'=>'1', 
                        'insertuser'=>$loguser, 
                        'insertdatetime'=>$updatedatetime, 
                        'tbl_customer_idtbl_customer'=>$customerID
                    );  
                    $addshipinsert=$this->db->insert('tbl_customer_address', $datashipadd);
                }
            }
            else{
                $deliveryname=$firstnamedrop.' '.$lastnamedrop;
                $deliverymobile=$phone;
                $deliverymobile2='';
                $deliveryaddressone=$streetaddress1drop.' '.$streetaddress2drop.' '.$citydrop;
                $deliveryaddresstwo='';
                $deliverycity=$citydrop;
                $otherdeliverystatus=1;
            }

            //Create Total Amount
            $subtotal=$this->cart->total();
            $nettotal=($subtotal-$discount)+$shipcost;

            //Check stock enough Start
            foreach($this->cart->contents() as $rowshopcart){
                $this->db->select('stock');
                $this->db->from('tbl_product');
                $this->db->where('idtbl_product', $rowshopcart['id']);
                $stockcheck = $this->db->get();

                $stockqty=$stockcheck->row(0)->stock;

                if($stockqty==0){
                    $outstockstatus=1;
                    break;
                }
            }
            //Check stock enough End

            if($outstockstatus==0){
                // Insert order Start
                $dataorder = array(
                    'orderdate'=>$orderdate, 
                    'shipcost'=>$shipcost, 
                    'total'=>$subtotal, 
                    'discount'=>$discount, 
                    'coupon'=>'', 
                    'nettotal'=>$nettotal, 
                    'acceptstatus'=>'0', 
                    'paystatus'=>'0', 
                    'shipstatus'=>'0', 
                    'deliverystatus'=>'0', 
                    'trackingno'=>'', 
                    'trackingweb'=>'', 
                    'dropshipstatus'=>'0', 
                    'callstatus'=>'0', 
                    'narration'=>$ordernotes, 
                    'cancelreason'=>'', 
                    'returnstatus'=>'0', 
                    'status'=>'1', 
                    'insertuser'=>$loguser, 
                    'insertdatetime'=>$updatedatetime, 
                    'updateuser'=>'', 
                    'updatedatetime'=>'', 
                    'tbl_customer_idtbl_customer'=>$respondcustomer->row(0)->idtbl_customer
                );  
                $orderinsert=$this->db->insert('tbl_order', $dataorder);
                $orderID=$this->db->insert_id();
                // Insert order End

                if($orderinsert){
                    foreach($this->cart->contents() as $rowshopcart){
                        $sqlcheckinsert="SELECT COUNT(*) AS `countcheck` FROM `tbl_order_detail` WHERE `qty`=? AND `status`=? AND `tbl_product_idtbl_product`=? AND `tbl_order_idtbl_order`=?";
                        $respondcheckinsert=$this->db->query($sqlcheckinsert, array($rowshopcart['qty'], 1, $rowshopcart['id'], $orderID));

                        if($respondcheckinsert->row(0)->countcheck==0){
                            $totalcost=($rowshopcart['qty']*$rowshopcart['price']);
                            
                            $this->db->select('stock');
                            $this->db->from('tbl_product');
                            $this->db->where('idtbl_product', $rowshopcart['id']);
                            $stockcheck = $this->db->get();

                            $stockqty=$stockcheck->row(0)->stock;

                            $balqty=$stockqty-$rowshopcart['qty'];

                            //Stock Maintain Start
                            $datastock = array(
                                'stock'=>$balqty
                            ); 
                            $this->db->where('idtbl_product', $rowshopcart['id']);
                            $stockupdate=$this->db->update('tbl_product', $datastock);
                            //Stock Maintain End

                            //Insert detail start
                            $dataorderdetail = array(
                                'productname'=>$rowshopcart['name'],
                                'qty'=>$rowshopcart['qty'],
                                'price'=>$rowshopcart['price'],
                                'total'=>$totalcost,
                                'status'=>'1',
                                'insertuser'=>$loguser,
                                'insertdatetime'=>$updatedatetime,
                                'updateuser'=>'',
                                'updatedatetime'=>'',
                                'tbl_order_idtbl_order'=>$orderID,
                                'tbl_product_idtbl_product'=>$rowshopcart['id']
                            );  
                            $orderdetailinsert=$this->db->insert('tbl_order_detail', $dataorderdetail);
                            //Insert detail end
                        }
                    }

                    // Insert Order Delivery Start
                    $dataorderdelivery = array(
                        'name'=>$deliveryname,
                        'mobile'=>$deliverymobile,
                        'mobile2'=>$deliverymobile2,
                        'address'=>$deliveryaddressone,
                        'city'=>$deliverycity,
                        'otherdeliverystatus'=>$otherdeliverystatus,
                        'insertdatetime'=>$updatedatetime,
                        'updateuser'=>'',
                        'updatedatetime'=>'',
                        'tbl_order_idtbl_order'=>$orderID
                    );  
                    $orderdeliveryinsert=$this->db->insert('tbl_order_delivery', $dataorderdelivery);
                    // Insert Order Delivery End

                    //Order Detail send via email
                    $message='';
                    $message.= '
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
                            <title>Herbline Order Information</title>

                        </head>

                        <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
                                                background-color: #FFFFFF;
                                                color: #000000;" bgcolor="#FFFFFF" text="#000000">
                            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
                                style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
                                        bgcolor="#FFFFFF">
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="560"
                                            style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;"
                                            class="wrapper">

                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; padding-top: 20px; padding-bottom: 20px;">
                                                    <div style="display: none; visibility: hidden; overflow: hidden; opacity: 0; font-size: 1px; line-height: 1px; height: 0; max-height: 0; max-width: 0; color: #FFFFFF;"
                                                        class="preheader">&nbsp;</div>
                                                    <a target="_blank" style="text-decoration: none;" href="#"><img border="0" vspace="0"
                                                            hspace="0" src="'.base_url().'images/logo.png" width="100%"
                                                            height="100%" alt="" title=""
                                                            style="color: #000000; font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;" /></a>

                                                </td>
                                            </tr>
                                        </table>
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560"
                                            style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;"
                                            class="container">
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: 500; line-height: 130%; padding-top: 25px; color: #000000; font-family: Helvetica; "
                                                    class="header">
                                                    Welcome to LAOL MART
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-bottom: 3px; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 14px; font-weight: 300; line-height: 150%; padding-top: 5px; color: #000000; font-family: sans-serif;"
                                                    class="subheader">
                                                    <hr style="border-style:dotted;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 3%; padding-right: 3%; width: 94%; font-size: 17px; font-weight: bold; line-height: 160%; padding-top: 15px; color: #000000; font-family: Helvetica;"
                                                    class="paragraph">
                                                    Order Information
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 3%; padding-right: 3%; width: 94%; padding-top: 15px;"
                                                    class="line">
                                                    <hr color="#E0E0E0" align="center" width="100%" size="1" noshade
                                                        style="margin: 0; padding: 0;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 3%; padding-right: 3%; padding-top: 15px;"
                                                    class="list-item">
                                                    <table align="center" border="0" cellspacing="0" cellpadding="0"
                                                        style="width: 100%; margin: 0; border-collapse: collapse; border-spacing: 0;">
                                                        <tr>
                                                            <th align="left" valign="top"
                                                                style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border-left: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; background-color: #f7f0ed;">
                                                                Order Number:</th>
                                                            <td align="left" valign="top"
                                                                style="font-size: 14px; line-height: 140%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-top: 10px; color: #000000; font-family: Helvetica; border-right: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC; background-color: #f7f0ed;"
                                                                class="paragraph">PO00'.$orderID.'
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" valign="top" style="font-size: 14px; line-height: 140%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-top: 10px; padding-bottom:10px; color: #000000; font-family: Helvetica; border: none" class="paragraph">
                                                                <table align="center" border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: 0; border-collapse: collapse; border-spacing: 0;">
                                                                    <tr>
                                                                        <th align="left" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;">Product</th>
                                                                        <th align="center" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            Qty
                                                                        </th>
                                                                        <th align="right" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            Unit Price
                                                                        </th>
                                                                        <th align="right" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            Total
                                                                        </th>
                                                                    </tr>';
                                                                    foreach($productemaillist as $rowshopcart){
                                                                    $message.='<tr>
                                                                        <td align="left" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;">
                                                                            '.$rowshopcart->product.'</td>
                                                                        <td align="center" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            '.$rowshopcart->qty.'
                                                                        </td>
                                                                        <td align="right" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            '.$rowshopcart->unit.'
                                                                        </td>
                                                                        <td align="right" valign="top"
                                                                            style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border: 1px solid #CCC;"
                                                                            class="paragraph">
                                                                            '.number_format(($rowshopcart->total), 2).'
                                                                        </td>
                                                                    </tr>';
                                                                    }
                                                                $message.='</table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th align="right" width="80%" valign="top"
                                                                style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border-left: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC;">
                                                                Total:</th>
                                                            <td align="right" valign="top"
                                                                style="font-size: 14px; line-height: 140%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-top: 10px; color: #000000; font-family: Helvetica; border-right: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC;"
                                                                class="paragraph">
                                                                '.number_format($subtotal,2).'
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th align="right" width="80%" valign="top"
                                                                style="border-collapse: collapse; border-spacing: 0; padding:10px; font-family: Helvetica; font-size: 14px; border-left: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC;">
                                                                NetTotal:</th>
                                                            <td align="left" valign="top"
                                                                style="font-size: 14px; line-height: 140%; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-top: 10px; color: #000000; font-family: Helvetica; border-right: 1px solid #CCC; border-top: 1px solid #CCC; border-bottom: 1px solid #CCC;"
                                                                class="paragraph">
                                                                '.number_format($nettotal,2).'
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  padding-bottom: 3px; padding-left: 3%; padding-right: 3%; width: 94%; font-size: 12px; line-height: 160%; padding-top: 15px; color: #757575; font-family: Helvetica;">
                                                    Please do not reply to this email. Emails sent to this address will not be answered.<br>Copyright © '.date('Y').' Sri Lanka
                                                    LAOL Mart, No.603, Colombo Road, Katunayeka. Sri Lanka. All rights reserved.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 3%; padding-right: 3%; width: 94%; padding-top: 25px;"
                                                    class="line">
                                                    <hr color="#E0E0E0" align="center" width="100%" size="1" noshade
                                                        style="margin: 0; padding: 0;" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 20px; padding-bottom: 25px; color: #000000; font-family: sans-serif;"
                                                    class="paragraph">
                                                    Have any question? <a href="mailto:info@laolmart.com" target="_blank"
                                                        style="color: #127DB3; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 160%;">info@laolmart.com</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </body>

                    </html>
                    ';

                    // $config['protocol'] = 'sendmail';
                    // $config['mailpath'] = '/usr/sbin/sendmail';
                    // $config['charset'] = 'utf-8';
                    // $config['wordwrap'] = TRUE;

                    $config['protocol'] = 'sendmail';
                    $config['smtp_host'] = 'localhost';
                    $config['smtp_user'] = '';
                    $config['smtp_pass'] = '';
                    $config['smtp_port'] = 25;

                    $this->email->initialize($config);
                    $this->email->set_mailtype("html"); 
                    $this->email->from('info@laolmart.com', 'LAOL Mart Customer Care Center');
                    $this->email->to('info@laolmart.com');
                    $this->email->bcc($respondcustomer->row(0)->email);

                    $this->email->subject('Order Information');
                    $this->email->message($message);

                    $this->email->send();

                    $this->cart->destroy();

                    if($paymenttype==1){
                        // redirect('Cart/Paymentgateway/'.$orderID.'/'.$nettotal);
                        $datapayorder = array(
                            'paystatus'=>'1'
                        ); 
                        $this->db->where('idtbl_order', $orderID);
                        $stockupdate=$this->db->update('tbl_order', $datapayorder);

                        $orderid = $orderID;
                        $merchant = "LAOLMARTNLKR";
                        $apipassword = "58ae32817e36e6ec5c445061d50d538e";
                        $returnUrl = base_url()."Cart/Requestcomplete";
                        $currency = "LKR";
                        $amount =$nettotal;
                        $apiUsername= "merchant.LAOLMARTNLKR";
                        $orderdesc="Laol Mart Order No: ".$orderID;

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL,"https://cbcmpgs.gateway.mastercard.com/api/nvp/version/55");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "apiOperation=CREATE_CHECKOUT_SESSION&apiUsername=$apiUsername&apiPassword=$apipassword&order.id=$orderid&order.amount=$amount&order.currency=$currency&order.description=$orderdesc&interaction.operation=PURCHASE&interaction.returnUrl=$returnUrl&interaction.merchant.name=LAOL%20Mart%20Holdings%20Pvt%20Ltd&merchant=$merchant");

                        $headers = array();
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        $result = curl_exec($ch);
                        if(curl_errno($ch)) {
                        echo 'ERROR:'. curl_error($ch);
                        }

                        curl_close($ch);

                        // print_r($result);
                        $sessionid = explode("=", explode("&", $result)[2])[1];
                        echo "
                        <script src=\"https://cbcmpgs.gateway.mastercard.com/checkout/version/55/checkout.js\" data-error=\"errorCallback\" data-cancel=\"cancelCallback\"></script>
                        <script type=\"text/javascript\">
                            function errorCallback(error) {
                                console.log(JSON.stringify(error));
                            }
                            function cancelCallback() {
                                console.log(\"Payment cancelled\");
                            }
                            Checkout.configure({
                            session: {
                                id : '$sessionid'
                            },
                            interaction: {
                                displayControl: {   
                                        billingAddress  : 'HIDE',  
                                        customerEmail   : 'HIDE',
                                        orderSummary    : 'SHOW',
                                        shipping        : 'HIDE'
                                }
                            }
                            });

                            //alert('test');
                            Checkout.showPaymentPage();
                            
                        </script>
                        ";
                    }
                    else{
                        redirect('Cart/Requestcomplete');
                    }
                }
                else{
                    $this->session->set_flashdata('msg', 'Your order not Proceed, please contact our operator.');
                    redirect('Cart/Checkoutproceed');
                }
            }
            else{
                $this->session->set_flashdata('msg', 'Some products are not available in stock, please check and remove in cart. Thank you.');
                redirect('Cart');
            }
        }
        else{
            $this->session->set_flashdata('msg', 'Please log your account or create new account and after proceed order. Thank You..');
            redirect('Cart/Checkout');
        }
    }
    public function Shipcost(){
        if(!empty($_SESSION['user_id'])){
            $userID=$_SESSION['user_id'];

            $this->db->select('city');
            $this->db->from('tbl_customer_address');
            $this->db->join('tbl_customer', 'tbl_customer.idtbl_customer = tbl_customer_address.tbl_customer_idtbl_customer');
            $this->db->where('tbl_customer_address.status', 1);
            $this->db->where('tbl_customer.insertuser ', $userID);

            $respondcusinfo=$this->db->get();

            if($respondcusinfo->num_rows()>0){
                $cityname=$respondcusinfo->row(0)->city;

                $this->db->select('amount, addkg');
                $this->db->from('tbl_city');
                $this->db->join('tbl_ship_rate', 'tbl_ship_rate.costalarea = tbl_city.costalarea');
                $this->db->where('tbl_city.city', $cityname);
                $this->db->where('tbl_city.status', 1);

                $respondcitycost=$this->db->get();

                $totalweight=0;
                
                foreach($this->cart->contents() as $rowshopcart){
                    $productID=$rowshopcart['id'];

                    $this->db->select('weight');
                    $this->db->from('tbl_product');
                    $this->db->where('idtbl_product', $productID);
                    $this->db->where('status', 1);

                    $respondweight=$this->db->get();

                    $totalweight=$totalweight+$respondweight->row(0)->weight;
                }

                $weightkg=$totalweight/1000;
                $addkg=floor($weightkg-1);

                if($addkg>=1){
                    $addcost=$respondcitycost->row(0)->addkg*$addkg;
                    $shipcost=$respondcitycost->row(0)->amount+$addcost;
                }
                else{
                    $shipcost=$respondcitycost->row(0)->amount;
                }
            }
            else{
                $shipcost=0;
            }

            return $shipcost;
        }
        else{
             return '0';
        }
    }
    public function Checkcityship(){
        $cityname=$this->input->post('dropcity');

        $this->db->select('amount, addkg');
        $this->db->from('tbl_city');
        $this->db->join('tbl_ship_rate', 'tbl_ship_rate.costalarea = tbl_city.costalarea');
        $this->db->where('tbl_city.city', $cityname);
        $this->db->where('tbl_city.status', 1);

        $respondcitycost=$this->db->get();

        $totalweight=0;
        
        foreach($this->cart->contents() as $rowshopcart){
            $productID=$rowshopcart['id'];

            $this->db->select('weight');
            $this->db->from('tbl_product');
            $this->db->where('idtbl_product', $productID);
            $this->db->where('status', 1);

            $respondweight=$this->db->get();

            $totalweight=$totalweight+$respondweight->row(0)->weight;
        }

        $weightkg=$totalweight/1000;
        $addkg=floor($weightkg-1);

        if($addkg>=1){
            $addcost=$respondcitycost->row(0)->addkg*$addkg;
            $shipcost=$respondcitycost->row(0)->amount+$addcost;
        }
        else{
            $shipcost=$respondcitycost->row(0)->amount;
        }

        echo $shipcost;
    }
}
?>