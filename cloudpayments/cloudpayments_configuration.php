<?php
/**
 * @package	HikaShop for Joomla!
 * @version	3.4.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2018 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');

function GetLang($string)
{
    $document = & JFactory::getDocument();
    require(dirname(__FILE__) . DS . 'language/'.$document->language.'/lang.php');
    if ($MESS[$string]) return $MESS[$string];
    else return $string;
} 

?>
<tr><td colspan="2"><?echo GetLang('VBCH_CLPAY_SPCP_DDESCR');?></td></tr>
<tr>
	<td class="key">
		<label for="data[payment][payment_params][PublicID]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_SHOP_ID');
		?>
    <span style="display:block;font-size:10px;"><?echo GetLang('SALE_HPS_CLOUDPAYMENT_SHOP_ID_DESC');?></span>
    </label>
	</td>
	<td>
		<input type="text" name="data[payment][payment_params][PublicID]" value="<?php echo $this->escape(@$this->element->payment_params->PublicID); ?>" />
	</td>
</tr>
<tr>
	<td class="key">
		<label for="data[payment][payment_params][APIPASS]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_SHOP_KEY');
		?>
    <span style="display:block;font-size:10px;"><?echo GetLang('SALE_HPS_CLOUDPAYMENT_SHOP_KEY_DESC');?></span>
    </label>
	</td>
	<td>
		<input type="text" name="data[payment][payment_params][APIPASS]" value="<?php echo $this->escape(@$this->element->payment_params->APIPASS); ?>" />
	</td>
</tr>
<tr>
	<td class="key">
		<label for="data[payment][payment_params][SuccessURL]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_SUCCESS_URL');
		?>
    </label>
	</td>
	<td>
		<input type="text" name="data[payment][payment_params][SuccessURL]" value="<?php echo $this->escape(@$this->element->payment_params->SuccessURL); ?>" />
	</td>
</tr>
<tr>
	<td class="key">
		<label for="data[payment][payment_params][FailURL]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_FAIL_URL');
		?></label>
	</td>
	<td>
		<input type="text" name="data[payment][payment_params][FailURL]" value="<?php echo $this->escape(@$this->element->payment_params->FailURL); ?>" />
	</td>
</tr>
<tr>
	<td class="key">
		<label for="data[payment][payment_params][WidjetLang]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_WIDGET_LANG');
		?></label>
	</td>
	<td>
    <select name="data[payment][payment_params][WidjetLang]">
          <option <?if ($this->element->payment_params->WidjetLang=='') echo 'selected';?> value=""></option>
          <option <?if ($this->element->payment_params->WidjetLang=='ru-RU') echo 'selected';?> value="ru-RU" selected=""><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_0')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='en-US') echo 'selected';?> value="en-US"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_1')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='lv') echo 'selected';?> value="lv"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_2')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='az') echo 'selected';?> value="az"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_3')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='kk') echo 'selected';?> value="kk"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_4')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='kk-KZ') echo 'selected';?> value="kk-KZ"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_5')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='uk') echo 'selected';?> value="uk"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_6')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='pl') echo 'selected';?> value="pl"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_7')?></option>
          <option <?if ($this->element->payment_params->WidjetLang=='pt') echo 'selected';?> value="pt"><?=GetLang('SALE_HPS_WIDGET_LANG_TYPE_8')?></option>
    </select>
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][PAYMENT_CURRENCY]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_CURRENCY');
		?></label>
	</td>
	<td>
    <select name="data[payment][payment_params][PAYMENT_CURRENCY]">
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='RUB') echo 'selected';?> value="RUB"><?=GetLang("RUB")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='EUR') echo 'selected';?> value="EUR"><?=GetLang("EUR")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='USD') echo 'selected';?> value="USD"><?=GetLang("USD")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='GBP') echo 'selected';?> value="GBP"><?=GetLang("GBP")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='UAH') echo 'selected';?> value="UAH"><?=GetLang("UAH")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='BYR') echo 'selected';?> value="BYR"><?=GetLang("BYR")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='BYN') echo 'selected';?> value="BYN"><?=GetLang("BYN")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='KZT') echo 'selected';?> value="KZT"><?=GetLang("KZT")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='AZN') echo 'selected';?> value="AZN"><?=GetLang("AZN")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='CHF') echo 'selected';?> value="CHF"><?=GetLang("CHF")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='CZK') echo 'selected';?> value="CZK"><?=GetLang("CZK")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='CAD') echo 'selected';?> value="CAD"><?=GetLang("CAD")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='PLN') echo 'selected';?> value="PLN"><?=GetLang("PLN")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='SEK') echo 'selected';?> value="SEK"><?=GetLang("SEK")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='TRY') echo 'selected';?> value="TRY"><?=GetLang("TRY")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='CNY') echo 'selected';?> value="CNY"><?=GetLang("CNY")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='INR') echo 'selected';?> value="INR"><?=GetLang("INR")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='BRL') echo 'selected';?> value="BRL"><?=GetLang("BRL")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='ZAL') echo 'selected';?> value="ZAL"><?=GetLang("ZAL")?></option>
        <option <?if ($this->element->payment_params->PAYMENT_CURRENCY=='UZS') echo 'selected';?> value="UZS"><?=GetLang("UZS")?></option>
    </select>    
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][CHECKONLINE]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_CHECKONLINE');
		?>
    <span style="display:block;font-size:10px;"><?echo GetLang('SALE_HPS_CLOUDPAYMENT_CHECKONLINE_DESC');?></span>
    </label>
	</td>
	<td>
<?php
		if(!isset($this->element->payment_params->CHECKONLINE))
			$this->element->payment_params->CHECKONLINE = 1;
		echo JHTML::_('hikaselect.booleanlist', "data[payment][payment_params][CHECKONLINE]" , '', $this->element->payment_params->CHECKONLINE);
	?>
	</td>
</tr>


<tr>
	<td class="key">
		<label for="data[payment][payment_params][TYPE_NALOG]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_TYPE_NALOG');
		?>
    <span style="display:block;font-size:10px;"><?echo GetLang('SALE_HPS_CLOUDPAYMENT_TYPE_NALOG_DESC');?></span>
    </label>
	</td>
	<td>
    <select name="data[payment][payment_params][TYPE_NALOG]">
        <option value=""></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='0') echo 'selected';?> value="0" selected=""><?=GetLang('SALE_HPS_NALOG_TYPE_0')?></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='1') echo 'selected';?> value="1"><?=GetLang('SALE_HPS_NALOG_TYPE_1')?></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='2') echo 'selected';?> value="2"><?=GetLang('SALE_HPS_NALOG_TYPE_2')?></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='3') echo 'selected';?> value="3"><?=GetLang('SALE_HPS_NALOG_TYPE_3')?></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='4') echo 'selected';?> value="4"><?=GetLang('SALE_HPS_NALOG_TYPE_4')?></option>
        <option <?if ($this->element->payment_params->TYPE_NALOG=='5') echo 'selected';?> value="5"><?=GetLang('SALE_HPS_NALOG_TYPE_5')?></option>
    </select>
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][TYPE_SYSTEM]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_TYPE_SYSTEM');
		?>
    </label>
	</td>
	<td>
    <select name="data[payment][payment_params][TYPE_SYSTEM]">
        <option <?if ($this->element->payment_params->TYPE_SYSTEM=='') echo 'selected';?> value=""></option>
        <option <?if ($this->element->payment_params->TYPE_SYSTEM=='0') echo 'selected';?> value="0" selected=""><?=GetLang('SALE_HPS_TYPE_SCHEME_0')?></option>
        <option <?if ($this->element->payment_params->TYPE_SYSTEM=='1') echo 'selected';?> value="1"><?=GetLang('SALE_HPS_TYPE_SCHEME_1')?></option></select>
    </select>
	</td>
</tr>

<tr><td colspan="2"><center><?echo GetLang('STATUS_GROUP');?></center></td></tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][STATUS_PAY]"><?php
			echo GetLang('STATUS_PAY');
		?></label>
	</td>
	<td>
		<?echo $this->data['order_statuses']->display("data[payment][payment_params][STATUS_PAY]", @$this->element->payment_params->STATUS_PAY); ?>
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][STATUS_CHANCEL]"><?php
			echo GetLang('STATUS_CHANCEL');
		?></label>
	</td>
	<td>
		<?echo $this->data['order_statuses']->display("data[payment][payment_params][STATUS_CHANCEL]", @$this->element->payment_params->STATUS_CHANCEL); ?>
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][STATUS_AU]"><?php
			echo GetLang('STATUS_AU');
		?></label>
	</td>
	<td>
		<?echo $this->data['order_statuses']->display("data[payment][payment_params][STATUS_AU]", @$this->element->payment_params->STATUS_AU); ?>
	</td>
</tr>

<tr>
	<td class="key">
		<label for="data[payment][payment_params][STATUS_AUTHORIZE]"><?php
			echo GetLang('STATUS_AUTHORIZE');
		?></label>
	</td>
	<td>
		<?echo $this->data['order_statuses']->display("data[payment][payment_params][STATUS_AUTHORIZE]", @$this->element->payment_params->STATUS_AUTHORIZE); ?>
	</td>
</tr>


<tr>
	<td class="key">
		<label for="data[payment][payment_params][STATUS_VOID]"><?php
			echo GetLang('STATUS_VOID');
		?></label>
	</td>
	<td>
		<?echo $this->data['order_statuses']->display("data[payment][payment_params][STATUS_VOID]", @$this->element->payment_params->STATUS_VOID); ?>
	</td>
</tr>


<tr>
	<td class="key">
		<label for="data[payment][payment_params][NDS]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_NDS');
		?>
    </label>
	</td>
	<td>
   <select name="data[payment][payment_params][NDS]">
        <option <?if ($this->element->payment_params->NDS=='') echo 'selected';?> value=""><?=GetLang('SALE_HPS_NDS_0')?></option>
        <option <?if ($this->element->payment_params->NDS=='18') echo 'selected';?> value="18"><?=GetLang('SALE_HPS_NDS_1')?></option>
        <option <?if ($this->element->payment_params->NDS=='10') echo 'selected';?> value="10"><?=GetLang('SALE_HPS_NDS_2')?></option>
        <option <?if ($this->element->payment_params->NDS=='0') echo 'selected';?> value="0"><?=GetLang('SALE_HPS_NDS_3')?></option>
        <option <?if ($this->element->payment_params->NDS=='110') echo 'selected';?> value="110"><?=GetLang('SALE_HPS_NDS_4')?></option>
        <option <?if ($this->element->payment_params->NDS=='118') echo 'selected';?> value="118"><?=GetLang('SALE_HPS_NDS_5')?></option>
    </select>
	</td>
</tr>


<tr>
	<td class="key">
		<label for="data[payment][payment_params][NDS_DELIVERY]"><?php
			echo GetLang('SALE_HPS_CLOUDPAYMENT_NDS_DELIVERY');
		?>
    </label>
	</td>
	<td>
    <select name="data[payment][payment_params][NDS_DELIVERY]">
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='') echo 'selected';?> value=""><?=GetLang('SALE_HPS_NDS_0')?></option>
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='18') echo 'selected';?> value="18"><?=GetLang('SALE_HPS_NDS_1')?></option>
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='10') echo 'selected';?> value="10"><?=GetLang('SALE_HPS_NDS_2')?></option>
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='0') echo 'selected';?> value="0"><?=GetLang('SALE_HPS_NDS_3')?></option>
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='110') echo 'selected';?> value="110"><?=GetLang('SALE_HPS_NDS_4')?></option>
        <option <?if ($this->element->payment_params->NDS_DELIVERY=='118') echo 'selected';?> value="118"><?=GetLang('SALE_HPS_NDS_5')?></option>
    </select>
	</td>
</tr>