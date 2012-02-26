<?php include_component('video', 'showwrapper', array('id'=>$id, 'title'=>$title)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>	

<p class="back">
	<a href="#top"><?php echo __('Go to top') ?></a>
</p>