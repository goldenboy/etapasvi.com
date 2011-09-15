<div id="offer_tr_ctr" >
<a href="javascript:switchOfferTr()" id="offer_tr_trigger">[<?php echo __('offer translation') ?>]</a>
<strong id="offer_tr_success" class="success small"><br/><?php echo __('Thanks! Your translation has been sent.') ?></strong>
<div id="offer_tr" class="box">
<iframe name="offer_tr_iframe" id="offer_tr_iframe_id" src=""></iframe>
<form action="<?php echo TextPeer::GOOGLE_DOC_OFFER_TRANSLATE ?>" method="POST" id="offer_tr_form" onsubmit="return offerTrSubmit()" target="offer_tr_iframe">
<input type="hidden" name="entry.5.single" value="<?php echo $uri ?>" id="offer_tr_uri"/>
<input type="hidden" name="entry.6.single" value="<?php echo $module ?>" />
<input type="hidden" name="entry.7.single" value="<?php echo $action ?>" />
<input type="hidden" name="entry.8.single" value="<?php echo $id ?>" />

<p>
    <?php echo __('Text') ?>:<br/><textarea name="entry.0.single" rows="8" ></textarea>
</p>
<p>
    <?php echo __('Translation') ?>:<br/><textarea name="entry.1.single" rows="8" ></textarea>
</p>
<p>
    <?php echo __('Language') ?>: 
    <select name="entry.4.single" id="entry_4">
        <option value=""></option>
        <?php foreach(UserPeer::$all_cultures as $culture_code => $culture_name): ?>
        <option value="<?php echo $culture_name; ?> [<?php echo $culture_code; ?>]"><?php echo $culture_name; ?></option>
        <?php endforeach ?>
    </select>
</p>
<p>
    <?php echo __('E-mail') ?>: <input type="text" name="entry.2.single" value="" /> (<?php echo __('optional') ?>)
</p>
<p>
    <?php echo __('Translated by') ?>: <input type="text" name="entry.3.single" value="" /> (<?php echo __('optional') ?>)
</p>
<input type="hidden" name="pageNumber" value="0" />
<input type="hidden" name="backupCache" value="" />
<input type="submit" name="submit" value="<?php echo __('Send') ?>" id="offer_tr_submit"/>
</form>
</div>
</div>