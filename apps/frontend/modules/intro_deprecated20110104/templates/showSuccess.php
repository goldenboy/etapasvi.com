<?php slot('body_id') ?>body_intro<?php end_slot() ?>

<h1><?php echo __('Intro') ?></h1>

<?php //include_component('text', 'show', array('id'=>2)); ?>

<img src="http://www.etapasvi.com/uploads/photo/thumb/87e2174e486359d74030c8d5a807c353.jpg" alt="<?php echo __('Ram Bahadur Bomjan') ?>" class="photo_incl"/>

<p>
<?php echo __('Ram Bahadur Bomjan, known as') ?> <a href="<?php echo url_for('@biography'); ?>"><?php echo __('Palden Dorje') ?></a> <?php echo __('(his monastic name) was born on'); ?> <?php echo __('full moon') ?>, <nobr><?php echo __('April 9,') ?></nobr> <?php echo __('1990 in 150 kilometers from Lumbini, the Ratanpuri village, Nepal') ?>.
</p>

<p class="p1">
<?php echo __('His parents are farmers. His mother,') ?> <?php echo __('Maya Devi') ?>, <?php echo __('was married at 12. Amazingly during delivery when only baby\'s head was just out of the womb, he let out a cry, that echoed in village.') ?>
</p>

<p class="p1">
<?php echo __('He started his meditation on May 16, 2005.') ?></p>
<p>
<?php echo __('After 7 months Ram was bitten by a snake and monks covered him with curtain. After five days it was opened and Ram spoke:') ?>
</p>
<p>
<?php echo __('«...A snake bit me but I do not need treatment. I need 6 years of deep meditation.»') ?></p>

<p class="p1">
<?php echo __('During 9 months he was motionless meditating near the Buddhist’s sacred tree without any food or water.') ?>
</p>

<?php include_component('video', 'show', array('id'=>33)); ?>

<p class="p1_no_bottom">
<?php echo __('On January 19, 2006 he spontaneously') ?> <a href="<?php echo url_for('video/show?id=30'); ?>" title="<?php echo __('Palden Dorje in fire') ?>"><?php echo __('combusted') ?></a><?php echo __(', burning off the clothes he has worn for nine months but leaving no scars. After some time in a very soft voice he called for his brother. He asked for a red robe to be thrown over him, he wrapped this close over his body, and he said, let him concentrate on his meditation and do not disturb him.') ?></p>
<p class="p1_no_bottom">
<?php echo __('There is stories of miracles: a girl and a young man had gained the') ?> <a href="<?php echo url_for('photo/show?id=15'); ?>" title="<?php echo __('miracle') ?>"><?php echo __('power of speech') ?></a> <?php echo __('although they could not speak...') ?> </p>
<p class="p1_no_top back"><a href="<?php echo url_for('@news_index'); ?>" title="<?php echo __('Read More about Buddha Boy') ?>" class="read_more"><?php echo __('Read more...') ?></a></p>

<?php /* 
<h3><?php echo __('Gautama Buddha') ?></h3>
<p><?php echo __('Siddhattha Gautama was born in 563 BCE in Lumbini (modern day Nepal). His mother was Maya Devi but she died in seven days after his delivery.') ?></p>
<p class="p1_no_bottom"><?php echo __('At the age of 29 he left his home and family to become a monk. Then, sitting under a tree he vowed never to arise until he had found the Truth.') ?></p>
<p class="p1_no_bottom"><?php echo __('At the age of 35 in the fifth lunar month he attaining enlightenment. Gautama, from then on, was known as the Buddha or "Awakened One." Buddha is also sometimes translated as "The Enlightened One."') ?></p>
*/ ?>

<?php /* <h2><?php echo __('Prophecies') ?></h2>*/ ?>
<br/>
<table class="news_list">
	<tr>
		<td><?php include_component('news', 'show', array('id'=>14)); ?></td>
	</tr>
	<tr>
		<td><?php include_component('news', 'show', array('id'=>9)); ?></td>
	</tr>	
</table>
<?php //include_component('news', 'show', array('id'=>12)); ?>
