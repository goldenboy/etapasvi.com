
<h1>cache</h1>

<?php if (!empty($refresh_processes)): ?>
<?php foreach($refresh_processes as $param=>$value): ?>
    <?php echo $value; ?><br/>
<?php endforeach; ?>
<?php endif ?>

<form action="" method="post" >  
	<input type="submit" value="Refresh" name="refresh_cache" />
</form>
<hr/>
<br/>

<form action="" method="post" >
    Path: <input type="text" name="path" value="<?php if (!empty($_POST['path'])): echo $_POST['path']; endif; ?>" size="100"/>    
	<br/>
    <input type="checkbox" <?php if (empty($_POST) || !empty($_POST['al_cultures'])): ?>checked="checked"<?php endif ?> name="al_cultures" /> All cultures
    <br/><br/>
	<input type="submit" value="Clear" name="clear" />
</form>
<?php if (!empty($clear_pathes)): ?>
<?php foreach($clear_pathes as $path): ?>
    <?php echo $path; ?><br/>
<?php endforeach; ?>
<?php endif ?>

<br/>
<hr/>
<br/>

<form action="" method="post" >  
	<input type="submit" value="Info" name="info" />
</form>
<?php if (!empty($cache_info)): ?>
<?php foreach($cache_info as $param=>$value): ?>
    <?php echo $param; ?>: <?php echo $value; ?><br/>
<?php endforeach; ?>
<?php endif ?>