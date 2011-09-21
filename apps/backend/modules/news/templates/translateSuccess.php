<h1>translate</h1>

<?php if($result): ?>
    <strong>Messages file:</strong><br/>
    <textarea style="width:95%;font-family:courier" rows="20" ><?php echo $result; ?></textarea><br/><br/>
<?php endif ?>

<form action="" method="POST">
    <strong>Plain text:</strong><br/>
    <textarea name="plain_text" style="width:95%;font-family:courier" rows="20" ><?php echo $_POST['plain_text']; ?></textarea><br/>
    <input name="get_as_file" type="checkbox" value="1" /> Get as messages file<br/>
    <input name="submit_convert" type="submit" value="Convert" />
</form>