<?php  
if (!defined('_VALID_MOS') && !defined('_JEXEC'))
	die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

if (!class_exists('hikashopPaymentPlugin'))
	require(dirname(__FILE__) . DS.'hikashopPaymentPlugin.php');
  


include_once($_SERVER['DOCUMENT_ROOT'].'/administrator/components/com_hikashop/helpers/helper.php');
hikashop_config();


                                               
class plgHikashoppaymentCloudPayments extends hikashopPaymentPlugin
{
	
	public $methodId;

	var $multiple = true;
	var $name = 'cloudpayments';
	var $doc_form = 'cloudpayments';
	/*var $pluginConfig = array(
		'publishable_key' => array('STRIPE_PUBLISHABLE_KEY', 'input'),
		'secret_key' => array('STRIPE_SECRET_KEY', 'input'),
		'debug' => array('DEBUG', 'boolean', '0'),
		'return_url' => array('RETURN_URL', 'input'),
		'invalid_status' => array('INVALID_STATUS', 'orderstatus'),
		'pending_status' => array('PENDING_STATUS', 'orderstatus'),
		'verified_status' => array('VERIFIED_STATUS', 'orderstatus')
	); */
  


  
	function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config); 
    
   // $this->updOrd(194);
    
    
    
    
    
	}
  
function updOrd($order_id)    
{
  $orderClass = hikashop_get('class.order');
  $updateOrder = new stdClass();
  $updateOrder->order_id=$order_id;
  $updateOrder->order_status='confirmed';
  if ($orderClass->save($updateOrder)) echo '1';    
  echo '1';  
}
  
  ////////////////////////////////////////////////////////////

  /** создаем кнопку после оформления заказа **/

  function get_pay_button(&$order, &$methods, $method_id)     ///ok
  {          
          $STATUS_CHANCEL= self::get_params('STATUS_CHANCEL');
          //self::addError(print_r($order,true)); die();
        //  self::addError(print_r($methods,true));
       //   self::addError(print_r(self::get_params(),true));
         //  self::addError(print_r($order->customer,true));
       
        //  die();
          if ($order->order_status!=$STATUS_CHANCEL):
             // 	$cart_sql = "SELECT * FROM `".WPSC_TABLE_CART_CONTENTS."` WHERE `purchaseid`='".$order['id']."'";
            //  	$cart = $wpdb->get_results($cart_sql,ARRAY_A) ;
                
                if ($order->cart->payment->payment_name=='Cloudpayments'):
                     // $Ar_params=self::get_params();
                      $params=self::get_params();
                      if (empty($params->WidjetLang)) $Ar_params['WidjetLang']="ru-RU";
                      else $Ar_params['WidjetLang']=$params->WidjetLang;
                      
                     
                    //  $Ar_params['description']=str_replace("#ORDER_ID#",$order['id'],self::get_lang_message('widget_description'));
                    //  $Ar_params['description']=str_replace("#SITE_NAME#",'http://'.$_SERVER['HTTP_HOST'],$Ar_params['description']);
                    //  $Ar_params['description']=str_replace("#DATE#",date("d-m-Y H:i:s"),$Ar_params['description']);
              
                      if ($params->CHECKONLINE) $Ar_params['CHECKONLINE']='Y';
                      else $Ar_params['CHECKONLINE']='N';
                      
                      if ($order->customer->user_email) $Ar_params['email']=$order->customer->user_email;
                      else $Ar_params['email']='';
                      
                      if ($order->cart->billing_address->address_telephone) $Ar_params['phone']=$order->cart->billing_address->address_telephone;
                      else $Ar_params['phone']='';
                      
                      if($params->CHECKONLINE==1):
                          if ($params->STATUS_PAY!=$order->order_status):
                                $data=array();
                                $items=array();
                                $local_currency_shipping=0;
                                $cart=self::object_to_array($order->cart);

                              	foreach($cart['products'] as $item):
                                    $items[]=array(
                                            'label'=>$item['order_product_name'],
                                            'price'=>number_format($item['order_product_price'],2,".",''),
                                            'quantity'=>$item['order_product_quantity'],
                                            'amount'=>number_format(floatval($item['order_product_price']*$item['order_product_quantity']),2,".",''),
                                            'vat'=>$params->NDS, ///     $Ar_params['cloudpayments_vat']
                                            'ean13'=>null
                                    ); 
                                 
                                   ///// $local_currency_shipping = $local_currency_shipping+$item['pnp'];       ????????
                                endforeach; 
                                
                                
                                //Добавляем доставку
                                if ($order->order_shipping_price > 0): 
                                    $items[] = array(
                                        'label' => 'Доставка',
                                        'price' => number_format($order->order_shipping_price, 2, ".", ''),
                                        'quantity' => 1,
                                        'amount' => number_format($order->order_shipping_price, 2, ".", ''),
                                        'vat' => $params->NDS_DELIVERY,   ///     $params->cloudpayments_vat
                                        'ean13' => null
                                    );
                                endif; 
                                $this->addError("________PRODUCTS++++++++");     
                                $this->addError(print_r($items,1));
                                $data['cloudPayments']['customerReceipt']['Items']=$items;
                                $data['cloudPayments']['customerReceipt']['taxationSystem']=$params->TYPE_NALOG; ///
                                $data['cloudPayments']['customerReceipt']['email']=$Ar_params['email']; 
                                $data['cloudPayments']['customerReceipt']['phone']=$Ar_params['phone'];  
                          endif;
                      endif;
        
                      $widget_f='charge';   
                                            
                      if ($params->TYPE_SYSTEM)
                      {
                          $widget_f='auth';
                      }    
                      
                      $params=array(
                          "lang_widget"=>$Ar_params['WidjetLang'],
                          "publicId"=>$params->PublicID,
                          "description"=>'',
                          "sum"=>$order->cart->full_total->prices[0]->price_value,
                          "PAYMENT_CURRENCY"=>$params->PAYMENT_CURRENCY,//"RUB",
                          "PAYMENT_BUYER_EMAIL"=>$Ar_params['email'],    
                          "PAYMENT_ID"=>$order->order_number,///order_id,
                          "PAYMENT_BUYER_ID"=>$order->cart->user_id,          
                          "CHECKONLINE"=>$params->CHECKONLINE,//"N",
                          "SUCCESS_URL"=>$params->SuccessURL,
                          "FAIL_URL"=>$params->FailURL,
                      );    
                        
                     $output = '
                      <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
                      <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
                      <button class="cloudpay_button" id="payButton">Оплатить</button>
                      <div id="result" style="display:none"></div>
                      <script type="text/javascript">
                          var payHandler = function () {
                              var widget = new cp.CloudPayments({'."language:'".$params['lang_widget']."'});
                              widget.".$widget_f."({ // options
                                      publicId: '".trim(htmlspecialchars($params["publicId"]))."',
                                      description: '".$params['description']."', 
                                      amount: ".number_format($params['sum'], 2, '.', '').",
                                      currency: '".$params['PAYMENT_CURRENCY']."',
                                      email: '".$params['PAYMENT_BUYER_EMAIL']."',
                                      invoiceId: '".htmlspecialchars($params["PAYMENT_ID"])."',
                                      accountId: '".htmlspecialchars($params["PAYMENT_BUYER_ID"])."',";
                                  if($params['CHECKONLINE']!='N'):
                                      $output .="data: ".self::cur_json_encode($data).",";
                                  endif;
                      
                                  $output .="},function (options) { ";
                                  if ($params['SUCCESS_URL']):
                                           $output .=' window.location.href="'.$params['SUCCESS_URL'].'"';
                                      else:
                                          $output .='BX("result").innerHTML="Success URL";
                                          BX.style(BX("result"),"color","green");
                                          BX.style(BX("result"),"display","block");';
                                      endif;
                                  $output .='},
                                  function (reason, options) { ';
                                      if ($params['FAIL_URL']):
                                           $output .='window.location.href="'.$params['FAIL_URL'].'"';
                                      else:
                                            $output .='BX("result").innerHTML=reason;
                                            BX.style(BX("result"),"color","red");
                                            BX.style(BX("result"),"display","block");';
                                      endif;
                                  $output .='});
                          };
                          $("#payButton").on("click", payHandler); 
                        ////  $("#payButton").trigger("click");
                      </script>';
                                   
                                    
                    //  if (get_option('cloudpayments_encoding')=='utf-8') $output=iconv("utf-8","cp1251",$output);
                      return $output;
              endif; 
        endif;       
  }
  


       ///order_invoice_number



	/** Срабатывает после оформления заказа **/
  
  public function onAfterOrderConfirm(&$order, &$methods, $method_id)   //ok  ----
  {
		parent::onAfterOrderConfirm($order, $methods, $method_id);
    $this->button=self::get_pay_button(&$order, &$methods, $method_id);  
  //  self::addError(print_r($this->payment_params,true));        
    return $this->showPage('end');
  } 

  /** Обработка изменения статуса заказа в админке **/
  
  public function onBeforeOrderUpdate($order,$methods)
  {      
        
        if (($order->order_payment_id && $order->old->order_status) OR ($order->old->order_payment_id && $order->old->order_status)):       
              global $oDb;
          		$oDb = JFactory::getDBO();
              if ($order->order_payment_id) $order_payment_id=$order->order_payment_id;
              else if($order->old->order_payment_id) $order_payment_id=$order->old->order_payment_id;
              
              if ($order->order_invoice_number) $order_invoice_number=$order->order_invoice_number;
              else if($order->old->order_invoice_number) $order_invoice_number=$order->old->order_invoice_number;
                      
          		$sSql = "SELECT `payment_type` FROM `#__hikashop_payment` where `payment_id`='".$order_payment_id."' LIMIT 1";
          		$oDb->setQuery($sSql);
          		$sRow = $oDb->loadAssocList();

              if ($sRow[0]['payment_type']=='cloudpayments'):
                    /** Если наша платежная система **/        
                		$this->pluginParams($order_payment_id);
                		$this->payment_params =& $this->plugin_params;
                    $params=self::Object_to_array($this->payment_params);  
                    if ($params['TYPE_SYSTEM']==1):
                    /** Для двухстадийно схемы **/
                          if ($params['STATUS_AU']==$order->old->order_status && $order->order_status==$params['STATUS_AUTHORIZE']):   
                                /** для двухстадийки - если заказ в статусе "платеж авторизован" и переведен в статус подтверждения платежа**/
                                if ($order_invoice_number):   
                                      self::confirm($order,$params,$order_invoice_number);
                                else:
                                     throw new Exception("Не указан order_invoice_number");
                                endif; 
                          elseif ($params['STATUS_VOID']==$order->order_status && $params['STATUS_AU']==$order->old->order_status):    
                          /** Отмена авторизованного платежа (Void) **/
                                if ($order_invoice_number):              
                                      self::void($order,$params,$order_invoice_number);
                                else:
                                      throw new Exception("Не указан order_invoice_number");
                                endif; 
                          elseif ($params['STATUS_CHANCEL']==$order->order_status):
                          /** Возврат платежа **/
                                if ($order_invoice_number):
                                      self::refund($order,$params,$order_invoice_number);
                                else:
                                      throw new Exception("Не указан order_invoice_number");
                                endif;
                          endif;
                    else:        
                          /** Одностадийная схема **/
                          if ($params['STATUS_CHANCEL']==$order->order_status):
                          /** Возврат платежа **/     
                                if ($order_invoice_number):
                                      self::refund($order,$params,$order_invoice_number);
                                else:
                                      throw new Exception("Не указан order_invoice_number");
                                endif;
                          endif;  
                    endif;
              endif;
        else:
              throw new Exception("Не указан order_payment_id или old_order_status");      
        endif;  
       // die();
       
  }   
  
 
  public function send_request($API_URL,$params,$request)
  {
          if($curl = curl_init()):
                self::addError("send_request");
                self::addError(print_r($request,1));
                $ch = curl_init($API_URL);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch,CURLOPT_USERPWD,$params['PublicID'] . ":" . $params['APIPASS']);
                curl_setopt($ch, CURLOPT_URL, $API_URL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
              	$content = curl_exec($ch);
          	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            		$curlError = curl_error($ch);
            		curl_close($ch);
          endif;
  }
  
  public function confirm($order,$params,$order_invoice_number)
  {
          self::addError("confirm two scheme");
          $API_URL='https://api.cloudpayments.ru/payments/confirm';
          $request=array(
              'TransactionId'=>$order_invoice_number,
              'Amount'=>number_format($order->order_full_price, 2, '.', ''),
            //  'JsonData'=>'',
          );
          self::send_request($API_URL,$params,$request);
  }

  public function SetTransactionId($order_id,$trans_id)
  {                                                         
        if ($order_id && $trans_id):
              global $oDb;
              $this->addError("---------1--------");
              $this->addError($order_id.'=='.$trans_id);
              $this->addError("---------2--------");
          		$oDb = JFactory::getDBO();
          		$sSql = "UPDATE `#__hikashop_order` SET `order_invoice_number` = '".$trans_id."', `order_invoice_id`='".$order_id."', `order_invoice_created`='".date("dmY")."'  WHERE `order_id` = ".$order_id;
          		$oDb->setQuery($sSql);
              $oDb->query(); 
       endif;       
  }

  public function OrderSetStatus($order_id,$params,$status)   //ok ----
  {                       
        $this->addError("---------OrderSetStatus--------");
  
        if ($order_id):
              global $oDb;
          		$oDb = JFactory::getDBO();
          	//	$sSql = "UPDATE `#__hikashop_order` SET `order_status` = '".$status."' WHERE `order_id` = ".$order_id;
          	//	$oDb->setQuery($sSql);
            //  $oDb->query(); 
              
          		$sSql = "INSERT INTO `#__hikashop_history` (`history_order_id`, `history_created`, `history_new_status`, `history_reason`) VALUES (".$order_id.", '".date("dmY")."', '".$status."', 'cloudpayments')";
          		$oDb->setQuery($sSql);
              $oDb->query();    
             /* $orderClass = hikashop_get('class.order');
              $updateOrder = new stdClass();
              $updateOrder->order_id=$order_id;
              $updateOrder->order_status=$status;
              $orderClass->save($updateOrder);   */
              $this->modifyOrder($order_id,$status,false,false);   
              $this->addError("---------OrderSetStatus999--------");          
        endif;
  }
  
  public function OrderSetPaySum($order_id,$sum)   //ok  ----
  {
        return true;
        if ($order_id):  
              global $oDb;
          		$oDb = JFactory::getDBO();
          		$sSql = "UPDATE `#__hikashop_order` SET `order_payment_price` = '".$sum."' WHERE `order_id` = ".$order_id;
          		$oDb->setQuery($sSql);
              $oDb->query(); 
        endif;
  }

  public function onPaymentNotification(&$statuses)  //ok ----
  {          
    if ($_GET['action']):
    $this->addError(print_r($_SERVER['REQUEST_URI'],1));
      		if ($_GET['notif_payment']):
              global $oDb;
          		$oDb = JFactory::getDBO();
          		$sSql = "SELECT `payment_id` FROM `#__hikashop_payment` where `payment_name`='".$_GET['notif_payment']."' LIMIT 1";
          		$oDb->setQuery($sSql);
          		$sRow = $oDb->loadAssocList();
              if ($sRow[0]):
                    $method_id=$sRow[0]['payment_id'];
              endif;
          endif;

      		$this->pluginParams($method_id);
      		$this->payment_params =& $this->plugin_params;
          $params=self::Object_to_array($this->payment_params); 
          if (!$params['STATUS_PAY']):
              $params['STATUS_PAY']='confirmed';
          endif;
          self::processRequest($_GET['action'],$_POST,$params);     //$_POST       
          die();
      endif;
  }
  



    function get_params($param=false)   ///OK   ---
    {
      if ($param) return $this->payment_params->$param;
      else return $this->payment_params;
    }



    /** Возврат платежа **/
  	public function refund($order,$params,$order_invoice_number)         ///ok
  	{
          self::addError("refund");

          $API_URL='https://api.cloudpayments.ru/payments/refund';
          $request=array(
              'TransactionId'=>$order_invoice_number,
              'Amount'=>number_format($order->order_full_price, 2, '.', ''),
            //  'JsonData'=>'',
          );
          self::send_request($API_URL,$params,$request);      
  	}
       
    /** Отмена авторизации платежа (двухстадийка) **/
  	public function void($order,$params,$order_invoice_number)         ///ok
  	{
          self::addError("void");

          $API_URL='https://api.cloudpayments.ru/payments/void';
          $request=array(
              'TransactionId'=>$order_invoice_number,
          );
          self::send_request($API_URL,$params,$request);      
  	}
    
                                    
    function Object_to_array($data)      //ok     ----
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = self::Object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
    
    private function CheckHMac($APIPASS)   //ok   ---
    {

        $headers = $this->detallheaders();      
        $this->addError(print_r($headers,true));        
                        
        if (isset($headers['Content-HMAC']) || isset($headers['Content-Hmac'])) 
        {
            $this->addError('HMAC_1');
            $this->addError($APIPASS);
            $message = file_get_contents('php://input');
            $s = hash_hmac('sha256', $message, $APIPASS, true);
            $hmac = base64_encode($s); 
            
            $this->addError(print_r($hmac,true));
            if ($headers['Content-HMAC']==$hmac) return true;
            else if($headers['Content-Hmac']==$hmac) return true;                                    
        }
        else return false;
    }
    
    
    private function detallheaders()  ///ok     ----
    {
        if (!is_array($_SERVER)) {
            return array();
        }
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    private function isCorrectOrderID($order, $request)    ///ok   ---
    {
        $oid = $request['InvoiceId'];
        $paymentid = $order['order_id'];
  
        return round($paymentSum, 2) == round($sum, 2);
    }

  	private function isCorrectSum($request,$order)  ////ok ----
  	{
  		$sum = $request['Amount']; 
  		$paymentSum = $order['order_full_price'];
  
  		return round($paymentSum, 2) == round($sum, 2);
  	}


    
  	public function get_order($request)   ///OK   ----
    {
        global $oDb;
        $this->addError('check_payment');
    		$oDb = JFactory::getDBO();
    		$sSql = "SELECT * FROM `#__hikashop_order` where  `order_number`='".$request['InvoiceId']."' LIMIT 1";
    		$oDb->setQuery($sSql);
    		$sRow = $oDb->loadAssocList();
        if ($sRow[0]):
            return $sRow[0]; 
        else: return false;
        endif;
    }
  
   
  	public function processCheckAction($request,$params)     /// ok -----
  	{                   
          $this->addError('processCheckAction');
          $order=self::get_order($request);
          if (!$order):
              json_encode(array("ERROR"=>'order empty'));
              die();
          endif;
          $accesskey=trim($params['APIPASS']);

          if($this->CheckHMac($accesskey))
          {
              if ($this->isCorrectSum($request,$order))
              {
                  $data['CODE'] = 0;
                  $this->addError('CorrectSum');
              }
              else
              {
                  $data['CODE'] = 11;
                  $errorMessage = 'Incorrect payment sum';
  
                  $this->addError($errorMessage);
              }
              
              $this->addError("Проверка заказа");
              
              $STATUS_CHANCEL= $params['STATUS_CHANCEL'];
              
              if($this->isCorrectOrderID($order, $request))
              {
                  $data['CODE'] = 0;
              }
              else
              {
                  $data['CODE'] = 10;
                  $errorMessage = 'Incorrect order ID';
                  $this->addError($errorMessage);
              }
  
              $orderID=$request['InvoiceId'];
  
              if($params['STATUS_PAY']==$order['order_status']):
                  $data['CODE'] = 13;
                  $errorMessage = 'Order already paid';
                  $this->addError($errorMessage);
              else:
                  $data['CODE'] = 0;
              endif;
  
               
              if ($params['STATUS_PAY']==$order['order_status'] || $order['order_status']==$STATUS_CHANCEL)
              {
                 $data['CODE'] = 13;
              }  
          }
          else
          {
              $errorMessage='ERROR HMAC RECORDS';
              $this->addError($errorMessage);  
              $data['CODE']=5204;            
          }
          
          $this->addError(json_encode($data));    
          
  		    echo json_encode($data);
  	}                       

    private function processFailAction($request,$params)    // ok ----
    {
        $order=self::get_order($request);
        
        $data['CODE'] = 0;
        self::OrderSetStatus($order['order_id'],$params,'pending');
        return $result;
    }
    
    
    private function processSuccessAction($request,$params)       ///ok  ----
    {
        $order=self::get_order($request);
        $TYPE_SYSTEM=$params['TYPE_SYSTEM'];    /** двухстадийка - 1 одностадийка - 0  **/
           $this->addError("---------processSuccessAction--------"); 
        if ($TYPE_SYSTEM==0):
              $data['CODE'] = 0;                         					
              self::OrderSetStatus($order['order_id'],$params,$params['STATUS_PAY']);
              self::SetTransactionId($order['order_id'],$request['TransactionId']);               //////////////////////////
              $this->addError('PAY_COMPLETE');
        else: 
              $data['CODE'] = 0;                         					
              self::OrderSetStatus($order['order_id'],$params,$params['STATUS_AU']);
              self::SetTransactionId($order['order_id'],$request['TransactionId']);               //////////////////////////
              ///self::OrderSetPaySum($order['order_id'],$request['PaymentAmount']);
              $this->addError('PAY_COMPLETE');    
        endif;
             $this->addError('----------data============');
                $this->addError(print_r($data,true));
                
       // $this->addError(print_r($request,true));
        //$this->addError(print_r($order,true));

        echo json_encode($data);
    }
    
    private function processRefundAction($request, $params)  ///ok   ----
    {
        $order=self::get_order($request);
        self::OrderSetStatus($order['order_id'],$params,$params['STATUS_CHANCEL']);
       // self::OrderSetPaySum($order['order_id'],'0');
        $data['CODE'] = 0;
        echo json_encode($data);
    }
    


	private function extractDataFromRequest($request)     ///
	{
		return array(
			'HEAD' => $request->get('action').'Response',
			'INVOICE_ID' =>  $request->get('InvoiceId')
		);
	}


  function cur_json_encode($a=false)      /////ok
  {
      if (is_null($a) || is_resource($a)) {
          return 'null';
      }
      if ($a === false) {
          return 'false';
      }
      if ($a === true) {
          return 'true';
      }
      
      if (is_scalar($a)) {
          if (is_float($a)) {
              //Always use "." for floats.
              $a = str_replace(',', '.', strval($a));
          }
  
          // All scalars are converted to strings to avoid indeterminism.
          // PHP's "1" and 1 are equal for all PHP operators, but
          // JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
          // we should get the same result in the JS frontend (string).
          // Character replacements for JSON.
          static $jsonReplaces = array(
              array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
              array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"')
          );
  
          return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
  
      $isList = true;
  
      for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
          if (key($a) !== $i) {
              $isList = false;
              break;
          }
      }
  
      $result = array();
      
      if ($isList) {
          foreach ($a as $v) {
              $result[] = self::cur_json_encode($v);
          }
      
          return '[ ' . join(', ', $result) . ' ]';
      } else {
          foreach ($a as $k => $v) {
              $result[] = self::cur_json_encode($k) . ': ' . self::cur_json_encode($v);
          }
  
          return '{ ' . join(', ', $result) . ' }';
      }
  }


  private function processconfirmAction($request,$params)   //ok  ---
  {     
      $order=self::get_order($request);
      $data['CODE'] = 0;                         					
      self::OrderSetStatus($order['order_id'],$params,$params['STATUS_PAY']);
    //  self::OrderSetPaySum($order['order_id'],$request['PaymentAmount']);
      $this->addError('PAY_COMPLETE');
      
    
      $this->addError(print_r($request,true));
      $this->addError(print_r($order,true));

      echo json_encode($data);
  }
   
	public function processRequest($action,$request,$params)   ///ok  ---
	{
	      //$result = new PaySystem\ServiceResult();
        $this->addError('processRequest - '.$action);
        $this->addError(print_r($request,true));

        if ($action == 'check')
        {
            return $this->processCheckAction($request,$params);    ///ok
            die();
        }
        else if ($action == 'fail')
        {
            return $this->processFailAction($request,$params);   //ok  
            die();
        }
        else if ($action == 'pay')
        {
            return $this->processSuccessAction($request,$params);   ///ok
            die();
        }
        else if ($action == 'refund')
        {
            return $this->processrefundAction($request,$params);     //ok
            die();
        }
        else if ($action == 'confirm')
        {
            return $this->processconfirmAction($request,$params);     //
            die();
        }      
        else if ($action == 'Cancel')
        {
            return $this->processrefundAction($request,$params);     //ok
            die();
        } 
        else
        {

            $data['TECH_MESSAGE'] = 'Unknown action: '.$action;
            $this->addError('Unknown action: '.$action.'. Request='.print_r($request,true));
            exit('{"code":0}');
        }

	}
  
  public function addError($text)              ///OK   ----
  {
        $debug=false;
        if ($debug)
        {
          $file=$_SERVER['DOCUMENT_ROOT'].'/plugins/hikashoppayment/cloudpayments/log.txt';
          $current = file_get_contents($file);
          $current .= date("d-m-Y H:i:s").":".$text."\n";
          file_put_contents($file, $current);
        }
  }
  
  /////////////////////////////////////////////////////////////

	
//throw new Exception

}