<?php slot('body_id') ?>body_servers<?php end_slot() ?>

<h1 id="up"><?php echo __('Servers') ?></h1>
<br />
<p>
    <?php echo __('If you have web server, you can help to deliver content of this website to the users. For instructions on how to add your server to website server farm email at') ?> <a href="<?php echo MailPeer::MAIL_ADDRESS ?>"><?php echo MailPeer::MAIL_ADDRESS ?></a>
</p>

<h2><?php echo __('Requirements') ?></h2>
<ul>
    <li><?php echo __('Unix-based server with Nginx and rsync installed') ?></li>
    <li><?php echo __('Owner must guarantee undisturbed operation of the server') ?></li>
    <li><?php echo __('Owner must be able to change Nginx configuration') ?></li>
    <li><?php echo __('Owner must be able to add SSH-key to ~/.ssh/authorized_keys') ?></li>
    <li><?php echo __('~500 Mb of disc space') ?></li>
</ul>

<?php if (!empty($server_list)): ?>
    <h2><?php echo __('List of web servers') ?></h2>
    <table cellspacing="0" cellpadding="0" class="table" width="100%">
    <tr>
        <th><?php echo __('#') ?></th>
        <th><?php echo __('IP') ?></th>
        <th><?php echo __('Owner') ?></th>
    </tr>
    <?php foreach($server_list as $i=>$server_row): ?>
        <?php 
        // 1-ю строку пропускаем
        if ($i == 0) {
            continue;
        }
        ?>
        <tr>
            <?php foreach($server_row as $col=>$server_item): ?>
                <?php if ($col > 2): ?>
                    <?php continue; ?>
                <?php endif ?>
                <td><?php echo $server_item; ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </table>
<?php endif ?>
<br/>
<h2><?php echo __('Website diagram') ?></h2>
<br/>
<a href="/uploads/all/etapasvi_com_diagram.jpg" target="_blank" title="<?php echo __('Website diagram') ?>">
    <img src="/uploads/all/etapasvi_com_diagram.jpg" width="100%" alt="<?php echo __('Website diagram') ?>" title="<?php echo __('Website diagram') ?>" />
</a>

<br /><br />
<?php include_component('comments', 'show'); ?>	