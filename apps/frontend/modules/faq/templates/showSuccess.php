<?php slot('body_id') ?>body_faq<?php end_slot() ?>

<?php $counter = 0; ?>

<h1 id="up"><?php echo __('FAQ') ?></h1>

<ol class="in_text">
	<?php /*<li><a href="#where_is_he"><?php echo __('Where is Dharma Sangha now?') ?></a></li> */ ?>
	<li><a href="#why_is_he_meditating"><?php echo __('Why is he meditating? What does he want to achieve?') ?></a></li>
	<li><a href="#is_he_enlightened"><?php echo __('Is Dharma Sangha already enlightened?') ?></a></li>
	<li><a href="#buddha"><?php echo __('Has he already become a Buddha?') ?></a></li>
	<li><a href="#teaching"><?php echo __('Is his teaching based on Buddhism or any other religions like Hinduism?') ?></a></li>
	<li><a href="#blessing"><?php echo __('How can I receive blessing from Dharma Sangha?') ?></a></li>
	<li><a href="#gifts"><?php echo __('I am going to Halkoriya Jungle. I would like to bring some gifts, what is the best choice?') ?></a></li>
	<li><a href="#get_to_halkoriya"><?php echo __('How can I get to Halkoriya Jungle?') ?></a></li>
</ol>

<?php /*
<h2 id="where_is_he"><?php echo ++$counter; ?>. <?php echo __('Where is Dharma Sangha now?') ?></h2>
<p>
<?php echo __('He is meditating in Halkoriya Jungle, Nepal\'s Bara District.') ?>
</p>
<center>
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?source=s_q&amp;f=q&amp;hl=ru&amp;geocode=&amp;q=Dharma+Sangha+Meditation+Site&amp;sll=37.0625,-95.677068&amp;sspn=52.152749,79.013672&amp;ie=UTF8&amp;hnear=&amp;radius=15000&amp;t=h&amp;cid=11992413955635615183&amp;oi=map_misc&amp;hq=Dharma+Sangha+Meditation+Sitel&amp;ll=27.202436,85.089074&amp;spn=0.001341,0.002411&amp;iwloc=A&amp;output=embed"></iframe>
</center>
*/ ?>
<h2 id="why_is_he_meditating"><?php echo ++$counter; ?>. <?php echo __('Why is he meditating? What does he want to achieve?') ?></h2>
<p>
<?php echo __('Dharma Sangha wants to liberate the whole world by spreading Dharma and insight he’ve gained through his meditation.') ?>
</p>


<h2 id="is_he_enlightened"><?php echo ++$counter; ?>. <?php echo __('Is Dharma Sangha already enlightened?') ?></h2>
<p>
<?php echo __('Yes, he is already enlightened.') ?>
</p>

<h2 id="buddha"><?php echo ++$counter; ?>. <?php echo __('Has he already become a Buddha?') ?></h2>
<p>
<?php echo __('Dharma Sangha can’t tell it now. Time will reveal.') ?>
</p>

<h2 id="teaching"><?php echo ++$counter; ?>. <?php echo __('Is his teaching based on Buddhism or any other religions like Hinduism?') ?></h2>
<p>
<?php echo __('It is actually called Bodhi Shravan Dharma, but it includes all religions, no one is excluded. Dharma Sangha will be moving forward by including all existing religions of the world.') ?>
</p>

<h2 id="blessing"><?php echo ++$counter; ?>. <?php echo __('How can I receive blessing from Dharma Sangha?') ?></h2>
<p>
<?php echo __('Please go to') ?> "<a href="<?php echo url_for('@blessing'); ?>"><?php echo __('Blessing') ?></a>".
</p>

<h2 id="gifts"><?php echo ++$counter; ?>. <?php echo __('I am going to Halkoriya Jungle. I would like to bring some gifts, what is the best choice?') ?></h2>
<p>
<?php echo __('Impractical gifts are not really good to bring (pictures, vases etc). Dharma Sangha does not accept gifts. If you still wish to contribute somehow, below is a list of small practical things, which are needed regularly in the jungle, and are of great value here. So if you really want to take something from your country or buy it in Kathmandu before you come, you can make things smooth at the site by bringing the following:') ?>
</p>
<ul>
    <li><?php echo __('Scissors.') ?></li>
    <li><?php echo __('Kitchenware (bigger pots, which bear direct fire, cutting knives, any kitchen tools, not electrical, as there is no much electricity on the site, bigger plastic buckets and storing boxes to keep food safe from monkey-robbers, etc.)') ?></li>
    <li><?php echo __('Pens and copybooks.') ?></li>
    <li><?php echo __('CANDLES – are a big necessity here (not perfumed ones).') ?></li>
    <li><?php echo __('If you have a give-away sleeping bag or blankets, it is always good for someone or guests.') ?></li>
    <li><?php echo __('Flashlights.') ?></li>
    <li><?php echo __('Sealed medicine with English leaflets (especially for cold-related illnesses, cough, disinfectant preparations for wounds, bands and first aid stuff).') ?></li>
    <li><?php echo __('Lighters.') ?></li>
    <li><?php echo __('100% natural material clothes or mats for sitting on the ground.') ?></li>
    <li><?php echo __('If anyone has a notebook or laptop, which he or she does not need, and which has a long-lasting battery, it would be also appreciated by the young monks, who are helping Khenpo to write and translate the texts of Dharma Sangha prayers and teachings, etc.') ?></li>
    <li><?php echo __('Soap, shampoo, laundry soap.') ?></li>
    <li><?php echo __('Mosquito nets and natural sprays.') ?></li>
</ul>

<h2 id="get_to_halkoriya"><?php echo ++$counter; ?>. <?php echo __('How can I get to Halkoriya Jungle?') ?></h2>
<p>
<?php echo __('The most convenience place for foreigner is to land in Kathmandu. From Kathmandu it is about 6 hours drive to Parsa Bridge if you can take a bus or a private vehicle. From Parsa Bridge to Halkoriya Jungle (about 6-7 km) you can take a tractor, which belongs to Bodhi Shrawan Dharma Sangha, or a 4-wheel vehicle to reach there. The road is a dry river bed and it is rough and bumpy ride.') ?>
</p>

<br/>
<?php include_component('comments', 'show'); ?>	

<p class="right_text">
	<a href="#up"><?php echo __('Go to top') ?></a>
</p>