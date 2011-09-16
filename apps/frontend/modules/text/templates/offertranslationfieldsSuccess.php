<p>
    <?php echo __('Use the form below to translate into any language information presented on this page. If you want to help with translation on a regular basis, please, email at') ?> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a>
</p>
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
        <option value="<?php echo $culture_code; ?>"><?php echo $culture_info['en']; ?> [<?php echo $culture_code; ?>] &nbsp;&nbsp;-&nbsp;&nbsp; <?php echo $culture_info['name']; ?></option>
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