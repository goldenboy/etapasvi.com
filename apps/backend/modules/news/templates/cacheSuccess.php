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
    <br/>
    <input type="text" name="refresh_exclude_path_regexp" size="50" value="<?php if (!empty($_POST['refresh_exclude_path_regexp'])):?><?php echo $_POST['refresh_exclude_path_regexp'];?><?php else: ?>/photo/(?!album)<?php endif ?>" />
    <input type="checkbox" <?php if (empty($_POST['refresh_exclude_path_regexp_flag']) || (!empty($_POST) && !empty($_POST['refresh_exclude_path_regexp_flag']))): ?>checked="checked"<?php endif ?> name="refresh_exclude_path_regexp_flag" /> Exclude path (override)
    <br/>
    <input type="text" name="refresh_include_path_regexp" size="50" value="<?php if (!empty($_POST['refresh_include_path_regexp'])):?><?php echo $_POST['refresh_include_path_regexp'];?><?php else: ?>/en/<?php endif ?>" />
    <input type="checkbox" <?php if (empty($_POST['refresh_include_path_regexp_flag']) || (!empty($_POST) && !empty($_POST['refresh_include_path_regexp_flag']))): ?>checked="checked"<?php endif ?> name="refresh_include_path_regexp_flag" /> Include path
    <br/>
	<input type="submit" value="Refresh" name="refresh_cache" />
</form>
<hr/>
<br/>

<form action="" method="post" style="float:left;">
    <input type="submit" value="Load" name="load_log_list"> &nbsp;
</form>
<form action="" method="post" target="_blank">
    <select name="pid">
        <?php foreach($log_list as $log): ?>
            <option value="<?php echo $log['pid'] ?>" ><?php echo $log['date'] ?>; pid: <?php echo $log['pid'] ?>; done: <?php echo $log['done'] ?></option>
        <?php endforeach ?>
    </select>
    <input type="submit" value="View" name="log">
</form>
<hr/>
<br/>

<form action="" method="post" >
    Path: <input type="text" name="path" value="<?php if (!empty($_POST['path'])): echo $_POST['path']; endif; ?>" size="100"/>     
    <input type="checkbox" <?php if (empty($_POST['path']) || !empty($_POST['al_cultures'])): ?>checked="checked"<?php endif ?> name="al_cultures" /> All cultures
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
    Path filter: <input type="text" name="info_path_filter" size="50" value="<?php if (!empty($_POST['info_path_filter'])):?><?php echo $_POST['info_path_filter'];?><?php else: ?>*<?php endif ?>" />
	<input type="submit" value="Info" name="info" />
</form>
<?php if (!empty($cache_info)): ?>
<?php foreach($cache_info as $param=>$value): ?>
    <?php echo $param; ?>: <?php echo $value; ?><br/>
<?php endforeach; ?>
<?php endif ?>