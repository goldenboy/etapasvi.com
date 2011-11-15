<?php if (count($revisionhistory)): ?>
<div id="revhistory" class="page_tools">
    <a href="javascript:switchRevhistory()" id="revhistory_trigger" class="page_tools_trigger">[<?php echo __('revision history') ?>]</a>
    <form action="http://www.w3.org/2007/10/htmldiff" target="_blank" class="box">
        <input type="radio" name="doc1" value="<?php echo sfContext::getInstance()->getRequest()->getUri(); ?>" checked="checked" /> <?php echo __('Current revision') ?><br/>
        <?php foreach($revisionhistory as $i=>$item): ?>
             <?php $item_url = $item->getUrl(); ?>
             <input type="radio" name="doc2" value="<?php echo $item_url; ?>" <?php if ($i == 0): ?>checked="checked"<?php endif ?> /> <a href="<?php echo $item_url; ?>" target="_blank"><?php echo format_datetime( $item->getCreatedAt(), 'd MMMM yyyy HH:mm:ss'); ?></a><br/>
        <?php endforeach ?>
        <br/>
        <input type="submit" value="<?php echo __('Compare selected revisions') ?>" class="input_button"/>
    </form>
</div>
<?php endif ?>