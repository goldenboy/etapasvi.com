<form action="" method="POST">
URL: <input type="text" name="url" value="<?php echo $_POST['url']?>" size="50"/>
<input type="submit" value="Get Page Mnemonic" />
</form>
<?php if ($page_mnemonic): ?>
    <?php echo $page_mnemonic; ?>
<?php endif ?>