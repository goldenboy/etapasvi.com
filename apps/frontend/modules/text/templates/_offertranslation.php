<div id="offer_tr_ctr" >
<a href="javascript:switchOfferTr('<?php echo url_for('offer_translation'); ?>', '<?php echo __('Error occured while loading form. Please, try again.') ?>')" id="offer_tr_trigger">[<?php echo __('offer translation') ?>]</a>
<p id="offer_tr_loader"><img src="/i/loader.gif" /></p>
<strong id="offer_tr_success" class="small success"><br/><?php echo __('Thanks! Your translation has been sent.') ?></strong>
<div id="offer_tr" class="box page_tools">
<iframe name="offer_tr_iframe" id="offer_tr_iframe_id" src=""></iframe>
<form action="<?php echo TextPeer::GOOGLE_DOC_OFFER_TRANSLATE ?>" method="POST" id="offer_tr_form" onsubmit="return offerTrSubmit()" target="offer_tr_iframe">
<input type="hidden" name="entry.5.single" value="<?php echo $uri ?>" id="offer_tr_uri"/>
<input type="hidden" name="entry.6.single" value="<?php echo $module ?>" />
<input type="hidden" name="entry.7.single" value="<?php echo $action ?>" />
<input type="hidden" name="entry.8.single" value="<?php echo $id ?>" id="offer_tr_id" />
<div id="offer_tr_fields"></div>
</form>
</div>
</div>