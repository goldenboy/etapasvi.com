<?php include_component('news', 'showwrapper', array('id'=>$id, 'title'=>$title)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>	

<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>