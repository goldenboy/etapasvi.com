<?php slot('body_id') ?>body_contactus<?php end_slot() ?>

<h1><?php echo __('Contact Us') ?></h1>

<?php /*include_component('text', 'show', array('id'=>3)); */ ?>

<p>
    <?php echo __('If you have any questions, please, try to find answer or ask on the') ?> <a href="<?php echo UserPeer::FORUM_URL; ?>"><?php echo __('Forum') ?></a>. <?php echo __('Send your message to the email below in case of special emergency only. It is difficult for website programmer to answer all emails (there are only 24 hours in a day).') ?>
</p>
<p>
    <strong><?php echo __('E-mail') ?>:</strong> <a href="mailto:<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a>
</p>
<?php /*
<p>
    <strong><?php echo __('Official website') ?>:</strong> <a href="http://www.dharmasangha.org.np">www.dharmasangha.org.np</a>
</p>
<p>
    <strong><?php echo __('News and Teachings') ?>:</strong> <a href="http://paldendorje.com">www.paldendorje.com</a>
</p>
*/ ?>
<?php /*
<?php if (!empty($chapter_list)): ?>
    <br/>
    <table cellspacing="0" cellpadding="0" id="chapter_list" class="table">
    <tr>
        <th><?php echo __('Country') ?></th>
        <th><?php echo __('State, District, City') ?></th>
        <th><?php echo __('Main in country') ?></th>
        <th><?php echo __('Mem- bers') ?></th>
        <th><?php echo __('Responsible person') ?></th>
        <th><?php echo __('E-mail') ?></th>
    </tr>
    <?php foreach($chapter_list as $i=>$chapter_row): ?>
        <?php 
        // 1-ю строку пропускаем
        if ($i == 0) {
            continue;
        }
        ?>
        <tr>
            <?php foreach($chapter_row as $chapter_item): ?>
                <td>
                <?php if (strstr($chapter_item, '@')): ?>
                    <a href="malto:<?php echo $chapter_item; ?>" class="small"><?php echo str_replace('@', ' @', $chapter_item); ?></a>
                <?php else: ?>
                    <?php echo $chapter_item; ?>
                <?php endif ?>
                </td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </table>
<?php endif ?>
*/ ?>
<br/>
<?php include_component('comments', 'show'); ?>	