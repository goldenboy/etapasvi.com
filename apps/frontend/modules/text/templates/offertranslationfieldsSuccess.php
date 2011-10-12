<p>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_form" onclick="showOfferTrMethod(this)"> <?php echo __('Translate News, Photo, Audio or Video, presented on this page into any language.') ?>
</p>
<p>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_messages" onclick="showOfferTrMethod(this)"> <?php echo __('Translate website interface from English into any other language.') ?>
</p>
<p>
    <a href="http://www.youtube.com/watch?v=WI4c1vT_yXg" target="_blank"><?php echo __('Watch video tutorial') ?></a>    
</p>
<p class="light small">
    <?php echo __('Before performing translation, make sure, that text you are going to translate is not translated yet on website.') ?>
</p>
<hr class="light"/>
<div id="offer_tr_method_messages" class="hidden offer_tr_method">
<br/>
<iframe frameborder="0" border="0" width="100%" height="810" src="/uploads/translate/index.html" ></iframe>
</div>

<div id="offer_tr_method_form" class="hidden offer_tr_method">
    <p>
        <?php echo __('Text') ?>:<br/>
        <span class="light">(<?php echo __('for example, if you translate news item, copy it\'s title and whole text into this field') ?>)</span>
        <br/><textarea name="entry.0.single" rows="8" ></textarea>
    </p>
    <p>
        <?php echo __('Translation') ?>:<br/>
        <span class="light">(<?php echo __('for example, if you translate news item, paste translation of it\'s title and text into this field') ?>)</span>
        <br/><textarea name="entry.1.single" rows="8" ></textarea>
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