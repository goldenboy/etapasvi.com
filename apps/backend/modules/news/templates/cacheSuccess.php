<h1>cache</h1>

<?php if (count($refresh_processes)): ?>
<table>
    <tr>
        <th>Action</th>
        <th>PID</th>
        <th>Done</th>
    </tr>
<?php foreach($refresh_processes as $param=>$value): ?>
    <tr>
        <td>
            <form action="" method="post" >
            <input type="submit" value="Kill" name="kill">
            <input type="hidden" value="<?php echo $value['pid']; ?>" name="pid">
            </form>
        </td>
        <td>
            <?php echo $value['pid']; ?>
        </td>
        <td>
            <?php echo $value['done']; ?>
        </td>
        <td>
            <form action="" method="post" target="_blank">
            <input type="submit" value="log" name="log">
            <input type="hidden" value="<?php echo $value['pid']; ?>" name="pid">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
<?php endif ?>

<form action="" method="post" >  
    <select name="refresh_cache_domain_name">
        <option value="">all</option>
        <?php foreach(UserPeer::$domain_name_list as $domain): ?>
            <option value="<?php echo $domain ?>" <?php if (!empty($_POST['refresh_cache_domain_name']) && $domain == $_POST['refresh_cache_domain_name']): ?>selected="selected"<?php endif ?> ><?php echo $domain ?></option>
        <?php endforeach ?>
    </select>
    <input type="checkbox" <?php if (empty($_POST['refresh_cache_domain_name']) || (!empty($_POST) && !empty($_POST['refresh_cache_multi_process']))): ?>checked="checked"<?php endif ?> name="refresh_cache_multi_process" /> Multi process 
    <input type="checkbox" <?php if (empty($_POST['refresh_cache_domain_name']) || (!empty($_POST) && !empty($_POST['refresh_cache_console']))): ?>checked="checked"<?php endif ?> name="refresh_cache_console" /> Console 
    <input type="text" name="refresh_exclude_path_regexp" value="<?php if (!empty($_POST['refresh_exclude_path_regexp'])):?><?php echo $_POST['refresh_exclude_path_regexp'];?><?php else: ?>\/photo\/(?!album)<?php endif ?>" />
    <input type="checkbox" <?php if (empty($_POST['refresh_exclude_path_regexp_flag']) || (!empty($_POST) && !empty($_POST['refresh_exclude_path_regexp_flag']))): ?>checked="checked"<?php endif ?> name="refresh_exclude_path_regexp_flag" /> Exclude path
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