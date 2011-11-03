<?php slot('body_id') ?>body_donation<?php end_slot() ?>

<h1 id="up"><?php echo __('Donation') ?></h1>

<h2 class="center"><?php echo __('Purpose') ?></h2>

<?php 
$news = NewsPeer::retrieveByPk(98);
$news_link = $news->getUrl();
?>
<p class="center_text">
<a href="<?php echo $news_link ?>" target="_blank"><?php echo $news_link ?></a>
</p>
<?php /*
<p>
<?php echo __('Bodhi Shrawan Dharma Sangha is planning for the auspicious day, when Dharma Sangha\'s meditation will end on May 17, Buddha Jayanti\'s day. After that Dharma Sangha will be giving blessings to devotees for 15 days from 9am to 6pm tentatively.') ?>
<br/><br/>
<?php echo __('We need to raise donation to cover meals for different religious leaders, who will be praying for world peace, prayer mandala, making tents for the religious leaders, devotees, bringing drinking water, medicines, road traffic, 500 volunteers (whom we are providing meals) for smooth process of getting blessings, projectors on hire, sound systems, flex, toilet facilities, etc.') ?>
<br/><br/>
<?php echo __('This is once in a lifetime way of giving offerings to this kind of auspicious ceremony and you will earn many merits in this lifetime, if you can help in this noble cause where about 300,000 people will get blessings.') ?>
</p>
*/
?>
<h2 class="center"><?php echo __('PayPal') ?></h2>
<div class="center_text">
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" value="_donations" name="cmd" />
    <input type="hidden" value="pld.hall@zoznam.sk" name="business" />
    <input type="hidden" value="US" name="lc" />
    <input type="hidden" value="dharmasangha.org.np" name="item_name" />
    <input type="hidden" value="0" name="no_note" />
    <input type="hidden" value="EUR" name="currency_code" />
    <input type="hidden" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest" name="bn" />
    <input type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" style="border:0" />
</form>
</div>

<h2 class="center"><?php echo __('SMS') ?></h2>
<p class="center_text">
<?php /*
<script type="text/javascript">
smsDonateId = 412067;
smsDonateButton = 1;
<?php if ($sf_user->getCulture() != 'ru'): ?>
smsDonateLanguage = "english";
<?php endif ?>
</script>
<script type="text/javascript" src="http://donate.smscoin.com/js/smsdonate.js"></script>
*/ 
?>

<script src="http://www.zaypay.com/pay/116564.js" type="text/javascript"></script><a href="http://www.zaypay.com/pay/116564" onclick="ZPayment(this); return false"><img src="http://www.zaypay.com/pay/116564/img" border="0" /></a>  

<?php /*
<script type="text/javascript">
$(document).ready(function(){
    $("#zay_pay_iframe").contents().find('body').html('<script src="http://www.zaypay.com/pay/116564.js" type="text/javascript"></script><a href="http://www.zaypay.com/pay/116564" onclick="ZPayment(this); return false"><img src="http://www.zaypay.com/pay/116564/img" border="0" /></a>');
});
</script>
*/ ?>

</p>

<h2 class="center"><?php echo __('Bank account') ?></h2>
<p class="center_text">    
<?php /*
    <strong>Organisation Name:</strong> Bodhi Shrawan Dharma Sangha
    <br/><strong>Bank Name:</strong> Standard Chartered Bank
    <br/><strong>Branch:</strong> Lazimpat Branch
    <br/><strong>Account No:</strong> 01-2231700-01
    <br/><strong>Street:</strong> Lazimpat 
    <br/><strong>Swift Code:</strong> SCBLNPKA
    <br/><strong>Address:</strong> P.O.Box 3990, Lazimpat, Kathmandu, Nepal
    <br/><strong>Tel:</strong> 977-1-4418456
    <br/><strong>Fax No:</strong> 977-1-4417428
*/ ?>
    <strong><?php echo __('Account Holder\'s Name') ?>:</strong> Nil Bdr / Tomasz Hen
    <br/><strong><?php echo __('Account Number') ?>:</strong> 00700501204269
    <br/><strong><?php echo __('Bank Name') ?>:</strong> Everest Bank Limited       
    <br/><strong><?php echo __('Branch') ?>:</strong> Simara Branch        
    <br/><strong><?php echo __('Address') ?>:</strong> Simara Chowk (street), Simara (sity), Bara (district), Nepal (country)
    <br/><strong><?php echo __('SWIFT (BIC)') ?>:</strong> EVBLNPKA
    <br/><strong><?php echo __('Phone') ?>:</strong> 977-53-520506 
    <br/><strong><?php echo __('Fax') ?>:</strong> 977-53-520616 
    <br/><strong>Email:</strong> eblsim@ebl.com.np
</p>

<h2 class="center"><?php echo __('Reports') ?></h2>
<div class="center_text">
<a href="https://docs.google.com/document/pub?id=1bIX95gsuNxFDxrTbopjKXTK3ypPk894SHiKZmEOoBGU" target="_blank"><?php echo __('Planned expenses') ?></a>
<br/><a href="https://docs.google.com/document/pub?id=1v46QPZq6iZnVWhmBRWRBSdVIqHW7kAsONfnbIWfViAI" target="_blank"><?php echo __('Income / Expenses') ?></a>
</div>

<br /><br />
<?php include_component('comments', 'show'); ?>	