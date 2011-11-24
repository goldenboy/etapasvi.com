<?php slot('body_id') ?>body_project<?php end_slot() ?>

<?php /*
<style type="text/css">
.bank_account td.ba_title {
	width: 170px;
	text-align: right;
}
.bank_account td.ba_value {
	padding-left: 15px;
	text-align: left;
}
</style>
*/ ?>


<h1 id="up"><?php echo __('Dharma Hall') ?></h1>

<div class="free_box_container">

    <?php $component_html = get_component('news', 'show', array('id'=>48, 'short'=>false)); ?>
    <?php if ($component_html): ?>
	<div class="box newsitem newsfull">
		<?php echo $component_html; ?>
	</div>
    <?php endif ?>

    <?php $component_html = get_component('news', 'show', array('id'=>49, 'short'=>false)); ?>
    <?php if ($component_html): ?>
	<div class="box newsitem newsfull">
		<?php echo $component_html; ?>
	</div>
    <?php endif ?>

	<?php include_component('video', 'show', array('id'=>46)); ?>

	<h2 class="center"><?php echo __('Location') ?></h2>
	<div class="center">
<?php /*
	<iframe width="480" height="385" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?source=embed&amp;f=q&amp;hl=<?php echo $sf_user->getCulture(); ?>?&amp;geocode=&amp;q=terguel+dharma+hall&amp;sll=37.0625,-95.677068&amp;sspn=52.152749,79.013672&amp;ie=UTF8&amp;hq=terguel+dharma+hall&amp;hnear=&amp;radius=15000&amp;t=h&amp;cid=2918620015855776320&amp;ll=27.22441,85.147648&amp;spn=0.053426,0.072956&amp;iwloc=A&amp;output=embed"></iframe>
*/
?>
	<iframe width="480" height="385" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=<?php echo $sf_user->getCulture(); ?>&amp;geocode=&amp;q=Terthup+Dharma+Hall&amp;sll=37.0625,-95.677068&amp;sspn=52.152749,79.013672&amp;ie=UTF8&amp;hq=Terthup+Dharma+Hall&amp;hnear=&amp;radius=15000&amp;ll=27.22441,85.147648&amp;spn=0.053426,0.072956&amp;t=h&amp;z=13&amp;iwloc=A&amp;cid=11992413955635615183&amp;output=embed"></iframe>	
	</div>
    <br/>
	<?php include_component('video', 'show', array('id'=>49)); ?>

    <?php /*
	<h2 class="center" id="donations"><?php echo __('Donation') ?></h2>
    <div class="center">
        <?php /*<a href="http://paldendorje.com/project/donation.html" target="_blank">http://paldendorje.com/project/donation.html</a> / ?>
        <a href="http://www.dharmasangha.org.np/en/Contents/donation.html" target="_blank">http://www.dharmasangha.org.np/en/Contents/donation.html</a>
    </div>
    */ ?>
    <?php /*
	<center>
	<strong>PayPal (USD)</strong><br/>
<?php /*
	<embed allowScriptAccess="always" src="http://www.chipin.com/widget/id/8f65248b8b9d6ef7" flashVars="chipin_server=www%2Echipin%2Ecom" type="application/x-shockwave-flash" wmode="transparent" width="220" height="220"></embed>
?>
    <form method="post" action="https://www.paypal.com/cgi-bin/webscr"> 
        <input type="hidden" name="cmd" value="_donations"> 
        <input type="hidden" name="business" value="lovetruthjoy@gmail.com"> 
        <input type="hidden" name="lc" value="US"> 
        <input type="hidden" name="item_name" value="Terthup Dharma Hall"> 
        <input type="hidden" name="item_number" value="paldendorje.com"> 
        <input type="hidden" name="currency_code" value="USD"> 
        <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted"> 
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="background-color:white;border:none;"> 
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> 
    </form>
	<br/>
	<strong>PayPal (EUR)</strong><br/>
<?php /
	<embed allowScriptAccess="always" src="http://www.chipin.com/widget/id/8f65248b8b9d6ef7" flashVars="chipin_server=www%2Echipin%2Ecom" type="application/x-shockwave-flash" wmode="transparent" width="220" height="220"></embed>
/?>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" style="border:0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
	<br/>
	<strong><?php echo __('Bank account (Nepal)') ?></strong><br/>
	<table class="bank_account">
		<tr><td class="ba_title"><?php echo __('ACCOUNT') ?>:</td><td class="ba_value">EVEREST BANK SIMARA  BRANCH</td></tr>
		<tr><td class="ba_title"><?php echo __('A/C HOLDER') ?>:</td><td class="ba_value">JAS/KRISHNA/MANU</td></tr>
		<tr><td class="ba_title"><?php echo __('A/C NO') ?>:</td><td class="ba_value">00700502200007</td></tr>
		<tr><td class="ba_title"><?php echo __('SWIFT CODE') ?>:</td><td class="ba_value">(EVBLNPKA)</td></tr>
	</table>
	<br/>
	<strong><?php echo __('Bank account (Europe)') ?></strong><br/>
	<table class="bank_account">
		<tr><td class="ba_title"><?php echo __('ACCOUNT') ?>:</td><td class="ba_value">DHARMA SANGHA HALL</td></tr>
		<tr><td class="ba_title"><?php echo __('A/C HOLDER') ?>:</td><td class="ba_value">JAN JURAK</td></tr>
		<tr><td class="ba_title"><?php echo __('A/C NO') ?>:</td><td class="ba_value">2600071215 / 2010</td></tr>
		<tr><td class="ba_title"><?php echo __('SWIFT CODE') ?>:</td><td class="ba_value">FIOZSKBAXXX</td></tr>
	</table>
	<br/>
	<strong>WebMoney</strong><br/>
	<code>R087336179278</code><br/><code>Z326012664229</code><br/><br/>
	<strong><?php echo __('Yandex Money') ?></strong><br/>
	<code>41001634550791</code>
<?php /
	<br/><br/>
	<a href="http://<?php echo $_SERVER['SERVER_NAME'] . "/uploads/all/dharma_hall_account_statement.xls"; ?>" class="external" target="_blank"><?php echo __('Donations Received') ?></a>
	</center>
/?>
*/?>


</div>

<br />
<?php include_component('comments', 'show'); ?>	