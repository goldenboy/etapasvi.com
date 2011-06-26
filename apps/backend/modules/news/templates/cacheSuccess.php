<h1>cache</h1>

<?php if (count($refresh_processes)): ?>
<form action="" method="post" >
<table>
    <tr>
        <th>Action</th>
        <th>PID</th>
        <th>Done</th>
    </tr>
<?php foreach($refresh_processes as $param=>$value): ?>
    <tr>
        <td>
            <input type="submit" value="Kill" name="kill">
            <input type="hidden" value="<?php echo $value['pid']; ?>" name="pid"> 
        </td>
        <td>
            <?php echo $value['pid']; ?>
        </td>
        <td>
            <?php echo $value['done']; ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>
</form>
<?php endif ?>

<form action="" method="post" >  
    <select name="refresh_cache_domain_name">
        <option value="">all</option>
        <?php foreach(UserPeer::$domain_name_list as $domain): ?>
            <option value="<?php echo $domain ?>" <?php if (!empty($_POST['refresh_cache_domain_name']) && $domain == $_POST['refresh_cache_domain_name']): ?>selected="selected"<?php endif ?> ><?php echo $domain ?></option>
        <?php endforeach ?>
    </select>
	<input type="submit" value="Refresh" name="refresh_cache" />
</form>
<hr/>
<br/>

<form action="" method="post" >
    Path: <input type="text" name="path" value="<?php if (!empty($_POST['path'])): echo $_POST['path']; endif; ?>" size="100"/>    
	<br/>
    <input type="checkbox" <?php if (empty($_POST['path']) || !empty($_POST['al_cultures'])): ?>checked="checked"<?php endif ?> name="al_cultures" /> All cultures
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
    <select name="info_domain_name">
        <option value="">all</option>
        <?php foreach(UserPeer::$domain_name_list as $domain): ?>
            <option value="<?php echo $domain ?>" <?php if (!empty($_POST['info_domain_name']) && $domain == $_POST['info_domain_name']): ?>selected="selected"<?php endif ?> ><?php echo $domain ?></option>
        <?php endforeach ?>
    </select>
	<input type="submit" value="Info" name="info" />
</form>
<?php if (!empty($cache_info)): ?>
<?php foreach($cache_info as $param=>$value): ?>
    <?php echo $param; ?>: <?php echo $value; ?><br/>
<?php endforeach; ?>
<?php endif ?>