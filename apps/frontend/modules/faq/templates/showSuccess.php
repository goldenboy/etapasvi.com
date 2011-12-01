<?php slot('body_id') ?>body_faq<?php end_slot() ?>

<?php $counter = 0; ?>

<h1 id="up"><?php echo __('FAQ') ?></h1>

<ol class="in_text">
	<li><a href="#where_is_he"><?php echo __('Where is Dharma Sangha now?') ?></a></li>
	<li><a href="#is_he_eating"><?php echo __('Is Dharma Sangha still not eating anything or just eating herbs from the jungle?') ?></a></li>
	<li><a href="#why_is_he_meditating"><?php echo __('Why is he meditating? What does he want to achieve?') ?></a></li>
	<li><a href="#is_he_enlightened"><?php echo __('Is Dharma Sangha already enlightened?') ?></a></li>
	<li><a href="#buddha"><?php echo __('Has he already become a Buddha?') ?></a></li>
	<li><a href="#teaching"><?php echo __('Is his teaching based on Buddhism or any other religions like Hinduism?') ?></a></li>
	<li><a href="#bodhi_shravan_dharma_sangha"><?php echo __('What does "Bodhi Shravan Dharma Sangha" mean?') ?></a></li>
	<li><a href="#blessing"><?php echo __('How can I receive blessing from Dharma Sangha?') ?></a></li>
	<li><a href="#gifts"><?php echo __('I am going to Halkhoriya Jungle. What should I take with me? I also would like to bring some gifts, what is the best choice?') ?></a></li>
	<li><a href="#get_to_halkhoriya"><?php echo __('How can I get to Halkhoriya Jungle?') ?></a></li> 
	<li><a href="#ratanpur_and_terthup"><?php echo __('How to reach Ratanpur and Terthup?') ?></a></li>
	<li><a href="#maitreya"><?php echo __('What does Jyampa, Ginphen, Maitri, Maitreya and Metta mean?') ?></a></li>
</ol>

<h2 id="where_is_he"><?php echo ++$counter; ?>. <?php echo __('Where is Dharma Sangha now?') ?></h2>
<p>
<?php echo __('He is meditating in Halkhoriya Jungle, Bara District in Nepal.') ?>
</p>
<?php /*
<center>
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?source=s_q&amp;f=q&amp;hl=ru&amp;geocode=&amp;q=Dharma+Sangha+Meditation+Site&amp;sll=37.0625,-95.677068&amp;sspn=52.152749,79.013672&amp;ie=UTF8&amp;hnear=&amp;radius=15000&amp;t=h&amp;cid=11992413955635615183&amp;oi=map_misc&amp;hq=Dharma+Sangha+Meditation+Sitel&amp;ll=27.202436,85.089074&amp;spn=0.001341,0.002411&amp;iwloc=A&amp;output=embed"></iframe>
</center> 
*/ ?>
<h2 id="is_he_eating"><?php echo ++$counter; ?>. <?php echo __('Is Dharma Sangha still not eating anything or just eating herbs from the jungle?') ?></h2>
<p>
<?php echo __('He is not eating anything.') ?>
</p>

<h2 id="why_is_he_meditating"><?php echo ++$counter; ?>. <?php echo __('Why is he meditating? What does he want to achieve?') ?></h2>
<p>
<?php echo __('Dharma Sangha wants to liberate the whole world by spreading Dharma and insight he’ve gained through his meditation.') ?>
</p>


<h2 id="is_he_enlightened"><?php echo ++$counter; ?>. <?php echo __('Is Dharma Sangha already enlightened?') ?></h2>
<p>
<?php echo __('Yes, he is already enlightened. The first stages of enlightenment occurred in his room at home.') ?>
</p>

<h2 id="buddha"><?php echo ++$counter; ?>. <?php echo __('Has he already become a Buddha?') ?></h2>
<p>
<?php echo __('Dharma Sangha can’t tell it now. Time will reveal.') ?>
</p>

<h2 id="teaching"><?php echo ++$counter; ?>. <?php echo __('Is his teaching based on Buddhism or any other religions like Hinduism?') ?></h2>
<p>
<?php echo __('It is actually called Bodhi Shravan Dharma Sangha, but it includes all religions, no one is excluded. Dharma Sangha will be moving forward by including all existing religions of the world.') ?>
</p>

<h2 id="bodhi_shravan_dharma_sangha"><?php echo ++$counter; ?>. <?php echo __('What does "Bodhi Shravan Dharma Sangha" mean?') ?></h2>
<ul>
    <li><?php echo __('Bodhi: enlightenment, awakened.') ?></li>
    <li><?php echo __('Shravan: attending to, heeding, listening.') ?></li>
    <li><?php echo __('Dharma: wisdom.') ?></li>
    <li><?php echo __('Sangha: association, assembly, community.') ?></li>
</ul>
<p>
<?php echo __('Thus "Bodhi Shravan Dharma Sangha" is the wisdom as heeded from enlightened ones.') ?>
</p>

<h2 id="blessing"><?php echo ++$counter; ?>. <?php echo __('How can I receive blessing from Dharma Sangha?') ?></h2>
<p>
<?php echo __('Please go to') ?> "<a href="<?php echo url_for('@blessing'); ?>"><?php echo __('Blessing') ?></a>".
</p>

<h2 id="gifts"><?php echo ++$counter; ?>. <?php echo __('I am going to Halkhoriya Jungle. What should I take with me? I also would like to bring some gifts, what is the best choice?') ?></h2>
<p>
<?php echo __('Impractical gifts are not really good to bring (pictures, vases, etc). Below is a list of small practical things, which are needed regularly in the jungle:') ?>
</p>
<ul>
    <li><?php echo __('Scissors.') ?></li>
    <li><?php echo __('Plastic buckets and boxes for storing food to keep it safe from monkey-robbers, etc.') ?></li>
    <li><?php echo __('Pens and copybooks.') ?></li>
    <li><?php echo __('CANDLES (not perfumed ones).') ?></li>
    <li><?php echo __('Sleeping bag, blankets, mat/mattress.') ?></li>
    <li><?php echo __('Flashlights (solar powered, if possible).') ?></li>
    <li><?php echo __('Sealed medicine with English leaflets (especially for colds, cough, wound disinfectants, bandages and first aid supplies).') ?></li>
    <li><?php echo __('Lighters.') ?></li>
    <li><?php echo __('100% natural material clothes or mats for sitting on the ground.') ?></li>
    <li><?php echo __('Soap, shampoo, laundry soap.') ?></li>
    <li><?php echo __('Mosquito nets and natural sprays.') ?></li>
</ul>

<h2 id="get_to_halkhoriya"><?php echo ++$counter; ?>. <?php echo __('How can I get to Halkhoriya Jungle?') ?></h2>
<p>
<?php echo __('The most convenience place for foreigner is to land in Kathmandu. From Kathmandu it is about 6 hours drive to Parsa Bridge if you can take a bus or a private vehicle. From Parsa Bridge to Halkhoriya Jungle (about 6-7 km) you can take a tractor, which belongs to Bodhi Shrawan Dharma Sangha, or a 4-wheel vehicle to reach there. The road is a dry river bed and it is rough and bumpy ride.') ?>
</p>

<h2 id="ratanpur_and_terthup"><?php echo ++$counter; ?>. <?php echo __('How to reach Ratanpur and Terthup?') ?></h2>
<p class="center_text">
<a href="/uploads/all/how_to_reach_ratanpur_and_therthup.jpg" target="_blank" title="<?php echo __('Download') ?>"><img src="/uploads/all/how_to_reach_ratanpur_and_therthup.jpg" alt="<?php echo __('How to reach Ratanpuri and Terthup?') ?>" width="565"/></a><br/><a href="/uploads/all/how_to_reach_ratanpur_and_therthup.jpg" target="_blank" title="<?php echo __('Enlarge') ?>"><?php echo __('Enlarge') ?></a>
</p>
<p class="center_text">
<iframe width="100%" height="385" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?t=h&amp;hl=ru&amp;ie=UTF8&amp;ll=27.244634,85.12987&amp;spn=0.005332,0.006813&amp;z=17&amp;output=embed"></iframe><br /><a href="http://maps.google.com/maps?t=h&amp;hl=ru&amp;ie=UTF8&amp;ll=27.244634,85.12987&amp;spn=0.005332,0.006813&amp;z=17&amp;source=embed" ><?php echo __('Terthup Dharma Hall') ?></a>
</p>
<p class="center_text">
<iframe width="100%" height="385" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?t=h&amp;hl=ru&amp;ie=UTF8&amp;ll=27.23581,85.126501&amp;spn=0.005332,0.006813&amp;z=17&amp;output=embed"></iframe><br /><a href="http://maps.google.com/maps?t=h&amp;hl=ru&amp;ie=UTF8&amp;ll=27.23581,85.126501&amp;spn=0.005332,0.006813&amp;z=17&amp;source=embed" ><?php echo __('Gompa, Ratanpur') ?></a>
</p>
<?php /*
<iframe width="480" height="385" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Terthup+Dharma+Hall&amp;sll=37.0625,-95.677068&amp;sspn=52.152749,79.013672&amp;ie=UTF8&amp;hq=Terthup+Dharma+Hall&amp;hnear=&amp;radius=15000&amp;ll=27.22441,85.147648&amp;spn=0.053426,0.072956&amp;t=h&amp;z=13&amp;iwloc=A&amp;cid=11992413955635615183&amp;output=embed"></iframe>
*/ ?>

<h2 id="maitreya"><?php echo ++$counter; ?>. <?php echo __('What does Jyampa, Ginphen, Maitri, Maitreya and Metta mean?') ?></h2>
<p>
<?php echo __('Jyampa, Ginphen, Maitri, Maitreya and Metta mean "loving kindness".') ?>
</p>

<br/>
<?php include_component('comments', 'show'); ?>

<p class="right_text">
	<a href="#up"><?php echo __('Go to top') ?></a>
</p>