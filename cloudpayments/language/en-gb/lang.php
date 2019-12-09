<?
$MESS['SALE_HPS_CLOUDPAYMENT'] = 'CloudPayments';
$MESS["SALE_HPS_CLOUDPAYMENT_SHOP_ID"] = "Public ID";
$MESS["SALE_HPS_CLOUDPAYMENT_SHOP_ID_DESC"] = "Access key (from the back-office CloudPayments)";
$MESS["SALE_HPS_CLOUDPAYMENT_SHOP_KEY"] = "Password for the API";
$MESS["SALE_HPS_CLOUDPAYMENT_SHOP_KEY_DESC"] = "Access password (from the back-office CloudPayments )";
$MESS["SALE_HPS_CLOUDPAYMENT_CHECKONLINE"] = "Use online cash register functionality";
$MESS["SALE_HPS_CLOUDPAYMENT_CHECKONLINE_DESC"] = "This functionality should be enabled on the CloudPayments side";
$MESS["SALE_HPS_CLOUDPAYMENT_PAYMENT_TYPE"] = "Payment system type";
$MESS["SALE_HPS_CLOUDPAYMENT_CURRENCY"] = "Order currency";
$MESS["SALE_HPS_CLOUDPAYMENT_INN"] = "TIN of the organization";
$MESS["SALE_HPS_CLOUDPAYMENT_INN_DESC"] = "TIN of your organization or PI for which the cash register is registered";
$MESS["SALE_HPS_CLOUDPAYMENT_TYPE_NALOG"] = 'Type of taxation system';
$MESS["SALE_HPS_CLOUDPAYMENT_TYPE_NALOG_DESC"] = 'This tax system must match one of the options registered in the cash register.';
$MESS["SALE_HPS_NALOG_TYPE_0"] = "General taxation system";
$MESS["SALE_HPS_NALOG_TYPE_1"] = "Simplified Taxation System (Income)";
$MESS["SALE_HPS_NALOG_TYPE_2"] = "Simplified taxation system (Income minus Expenditure)";
$MESS["SALE_HPS_NALOG_TYPE_3"] = "Single tax on imputed income";
$MESS["SALE_HPS_NALOG_TYPE_4"] = "Unified Agricultural Tax";
$MESS["SALE_HPS_NALOG_TYPE_5"] = "Patent system of taxation";
$MESS["VBCH_CLPAY_SPCP_DDESCR"] = "<a href=\"http://www.http://cloudpayments.ru/\"> CloudPayments </a>. <br> Receiving payments online using a bank card through the system CloudPayments <Br/>
Go to the back-office CloudPayments  and change the following paths: <br/>
Settings Notifications notification: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=check<br/>
Pay notification settings: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=pay<br/>
Fail notification settings: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=fail<br/>
Cancel notification settings: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=cancel<br/>
Confirm notification settings: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=confirm<br/>
Refund notification settings: http://".$_SERVER['HTTP_HOST']."/index.php?option=com_hikashop&ctrl=checkout&task=notify&notif_payment=cloudpayments&tmpl=component&lang=ru&action=refund<br/><br/>";

$MESS["SALE_HPS_CLOUDPAYMENT_TYPE_SYSTEM"] = "Payment scheme type";
$MESS["SALE_HPS_TYPE_SCHEME_0"] = "One-Step Payment";
$MESS["SALE_HPS_TYPE_SCHEME_1"] = "Two-Step Payment";

$MESS["SALE_HPS_CLOUDPAYMENT_SUCCESS_URL"] = "Success URL";
$MESS["SALE_HPS_CLOUDPAYMENT_SUCCESS_URL_DESC"] = "";
$MESS["SALE_HPS_CLOUDPAYMENT_FAIL_URL"] = "Fail URL";
$MESS["SALE_HPS_CLOUDPAYMENT_FAIL_URL_DESC"] = "";
$MESS["SALE_HPS_CLOUDPAYMENT_WIDGET_LANG"] = "Widget Language";
$MESS["SALE_HPS_CLOUDPAYMENT_WIDGET_LANG_DESC"] = "";

$MESS["SALE_HPS_WIDGET_LANG_TYPE_0"] = "Russian MSK";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_1"] = "English CET";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_2"] = "Latvian CET";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_3"] = "Azerbaijani AZT";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_4"] = "Russian ALMT";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_5"] = "Kazakh ALMT";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_6"] = "Ukrainian EET";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_7"] = "Polish CET";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_8"] = "Portuguese CET";
$MESS["SALE_HPS_WIDGET_LANG_TYPE_9"] = "Czech CET";

$MESS["SALE_HPS_CLOUDPAYMENT_VAT_DELIVERY"] = "Select Shipping VAT, if necessary";
$MESS["SALE_HPS_CLOUDPAYMENT_VAT_DELIVERY_DESC"] = "";

$MESS["VAT"] = "Select VAT for shipping if necessary";
$MESS["NOT_VAT"] = "Without VAT";

$MESS["DELIVERY_VAT0"] = "Without VAT";
$MESS["DELIVERY_VAT1"] = "VAT 20";
$MESS["DELIVERY_VAT2"] = "VAT 10%";
$MESS["DELIVERY_VAT3"] = "VAT 0%";
$MESS["DELIVERY_VAT4"] = "estimated VAT 10/110";
$MESS["DELIVERY_VAT5"] = "estimated VAT 20/120";

$MESS["STATUS_AU"] = "Authorized status";
$MESS["STATUS_VOID"] = "Canceled status";
$MESS["STATUS_GROUP"] = "Statuses";
$MESS["STATUS_GROUP"] = "Statuses";
$MESS["STATUS_PAY"] = "Paid status";
$MESS["STATUS_CHANCEL"] = "Refund Status";
$MESS["STATUS_AUTHORIZE"]= "Сanceled order(two-stage payments)";


$MESS["RUB"] = "The Russian Ruble";
$MESS["EUR"] = "Euro";
$MESS["USD"] = "US Dollar";
$MESS["GBP"] = "Pound Sterling";
$MESS["UAH"] = "Ukrainian Hryvnia";
$MESS["BYR"] = "Belarusian ruble (not used since July 1, 2016)";
$MESS["BYN"] = "The Belarusian Ruble";
$MESS["KZT"] = "Kazakh tenge";
$MESS["AZN"] = "Azerbaijani manat";
$MESS["CHF"] = "Swiss franc";
$MESS["CZK"] = "The Czech crown";
$MESS["CAD"] = "Canadian Dollar";
$MESS["PLN"] = "Polish zloty";
$MESS["SEK"] = "Swedish Krona";
$MESS["TRY"] = "Turkish Lira";
$MESS["CNY"] = "Chinese yuan";
$MESS["INR"] = "Indian Rupee";
$MESS["BRL"] = "Brazilian Real";
$MESS["ZAL"] = "South African Rand";
$MESS["UZS"] = "Uzbek Sum";
$MESS["BGL"] = "Bulgarian Lev";

$MESS["SALE_HPS_CLOUDPAYMENT_NDS"] = "VAT for the order";
$MESS["SALE_HPS_CLOUDPAYMENT_NDS_DELIVERY"] = "Shipping VAT";

$MESS["SALE_HPS_NDS_0"] = "Without VAT";
$MESS["SALE_HPS_NDS_1"] = "VAT 20%";
$MESS["SALE_HPS_NDS_2"] = "VAT 10%";
$MESS["SALE_HPS_NDS_3"] = "VAT 0%";
$MESS["SALE_HPS_NDS_4"] = "estimated VAT 10/110";
$MESS["SALE_HPS_NDS_5"] = "estimated VAT 20/120";
?>