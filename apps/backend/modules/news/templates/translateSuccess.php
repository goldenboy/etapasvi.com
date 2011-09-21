<h1>translate</h1>

<?php if($result): ?>
    Messages file:<br/>
    <textarea style="width:95%;font-family:courier" rows="20" ><?php echo $result; ?></textarea>
<?php endif ?>

<form action="" method="POST">
    Plain text:<br/>
    <textarea name="text_to_convert" style="width:95%;font-family:courier" rows="20" ></textarea><br/>
    <input name="get_as_file" type="checkbox" value="1" /> Get as messages file<br/>
    <input name="submit_convert" type="submit" value="Convert" />
</form>