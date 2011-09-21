<p>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_form" onclick="showOfferTrMethod(this)"> <?php echo __('Translate information presented on this page into any language.') ?>
    <br/>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_messages" onclick="showOfferTrMethod(this)"> <?php echo __('Translate website interface from English into any language.') ?>
</p>

<iframe frameborder="0" border="0" width="100%" height="814" src="/uploads/translate/index.html" id="offer_tr_method_messages" class="hidden offer_tr_method"></iframe>

<div id="offer_tr_method_form" class="hidden offer_tr_method">
    <p>
        <?php echo __('Text') ?>:<br/><textarea name="entry.0.single" rows="8" ></textarea>
    </p>
    <p>
        <?php echo __('Translation') ?>:<br/><textarea name="entry.1.single" rows="8" ></textarea>
    </p>
    <table cellspacing="0" cellpadding="0" class="form_table">
    <tr>
        <td><?php echo __('Language') ?>:</td>
        <td><select name="entry.4.single" id="entry_4">
            <option value=""></option>
            <?php foreach(UserPeer::$all_cultures as $culture_code => $culture_info): ?>
            <option value="<?php echo $culture_code; ?>"><?php echo UserPeer::getCultureFullName($culture_code); ?></option>
            <?php endforeach ?>
        </select>
        </td>
    </tr>
    <tr>
        <td><?php echo __('Email') ?>: </td><td><input type="text" name="entry.2.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    <tr>
        <td><?php echo __('Translated by') ?>: </td><td><input type="text" name="entry.3.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    <tr>
        <td><?php echo __('Comment') ?>: </td><td><input type="text" name="entry.9.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    </table>
    <input type="hidden" name="pageNumber" value="0" />
    <input type="hidden" name="backupCache" value="" />
    <p class="center_text">
        <input type="submit" name="submit" value="<?php echo __('Send') ?>" id="offer_tr_submit"/>
    </p>
</div>