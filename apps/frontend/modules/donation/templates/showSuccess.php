<?php slot('body_id') ?>body_donation<?php end_slot() ?>

<h1 id="up"><?php echo __('Donation') ?></h1>
<?php /*
<h2 class="center"><?php echo __('Purpose') ?></h2>
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

<h2 class="center"><?php echo __('Bank account') ?></h2>
<p class="center_text">
    <?php /*<a href="http://paldendorje.com/project/donation.html" target="_blank">http://paldendorje.com/project/donation.html</a> */ ?>
    <a href="http://www.dharmasangha.org.np/en/Contents/donation.html" target="_blank">http://www.dharmasangha.org.np/en/Contents/donation.html</a>
    <br/><br/>    
    <strong>Organisation Name:</strong> Bodhi Shrawan Dharma Sangha
    <br/><strong>Bank Name:</strong> Standard Chartered Bank
    <br/><strong>Branch:</strong> Lazimpat Branch
    <br/><strong>Account No:</strong> 01-2231700 01
    <br/><strong>Street:</strong> Lazimpat 
    <br/><strong>Swift Code:</strong> SCBLNPKA
    <br/><strong>Address:</strong> P.O.Box 3990, Lazimpat, Kathmandu, Nepal
    <br/><strong>Tel:</strong> 977-1-4418456
    <br/><strong>Fax No:</strong> 977-1-4417428
</p>
<br /><br />
<?php include_component('comments', 'show'); ?>	