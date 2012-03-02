<h1>cache</h1>

<?php if (count($refresh_cache_daemon_info)): ?>
<?php
foreach($refresh_cache_daemon_info as $key=>$value) {
    echo '<strong>' . $key . ': </strong>' . $value;
}
?>

<form action="" method="post" >
<input type="submit" value="Kill" name="kill">
<input type="hidden" value="<?php echo $refresh_cache_daemon_info['pid']; ?>" name="pid">
</form>

<form action="" method="post" target="_blank">
<input type="submit" value="log" name="log">
<input type="hidden" value="<?php echo $refresh_cache_daemon_info['pid']; ?>" name="pid">
</form>
<hr/>
<br/>
<?php endif ?>

<?php if ($error_message): ?>
    <strong><?php echo $error_message ?></strong>
    <br/><br/>
<?php endif ?>

<form action="" method="post" >  
    <select name="refresh_cache_domain_name">
        <option value="">all</option>
        <?php foreach(UserPeer::$domain_name_list as $domain): ?>
            <option value="<?php echo $domain ?>" <?php if (!empty($_POST['refresh_cache_domain_name']) && $domain == $_POST['refresh_cache_domain_name']): ?>selected="selected"<?php endif ?> ><?php echo $domain ?></option>
        <?php endforeach ?>
    </select>
    <input type="checkbox" <?php if ((!empty($_POST) && !empty($_POST['refresh_cache_multi_process']))): ?>checked="checked"<?php endif ?> name="refresh_cache_multi_process" /> Multi process 
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
<br/>

<form action="" method="post" style="float:left;">
    <input type="submit" value="Load" name="load_log_list"> &nbsp;
</form>
<form action="" method="post" target="_blank">
    <select name="pid">
        <?php foreach($log_list as $log): ?>
            <option value="<?php echo $log['pid'] ?>" >
            <?php 
            foreach($log as $key=>$value) {
                echo $key . ':' . $value . '; ';
            } 
            ?>
            </option>
        <?php endforeach ?>
    </select>
    <input type="submit" value="View" name="log">
</form>
<hr/>
<br/>

<form action="" method="post" >
    Item by ID: 
    <input type="text" value="<?php if (!empty($_POST['clear_item_id'])): echo $_POST['clear_item_id']; endif; ?>" name="clear_item_id" /> 
    <select name="clear_item_type_name">
        <?php foreach($item_types as $item_type): ?>
            <option value="<?php echo $item_type->getName(); ?>" 
                <?php if ($item_type->getName() == $_POST['clear_item_type_name']): ?>selected="selected"<?php endif ?>
            ><?php echo $item_type->getName(); ?></option>
        <?php endforeach ?>
    </select>    
    <select name="clear_item_culture">
        <option value="all">all</option>
        <?php foreach(UserPeer::getCultures() as $culture): ?>
            <option value="<?php echo $culture; ?>" 
                <?php if ($culture == $_POST['clear_item_culture']): ?>selected="selected"<?php endif ?>
            ><?php echo $culture; ?></option>
        <?php endforeach ?>
    </select>    
	<input type="submit" value="Clear" name="clear_item_submit" /> 	
</form>
<br/>

<form action="" method="post" >
    Clear on any content change: 
    <select name="clear_on_any_change_culture">
        <option value="all">all</option>
        <?php foreach(UserPeer::getCultures() as $culture): ?>
            <option value="<?php echo $culture; ?>" 
                <?php if ($culture == $_POST['clear_on_any_change_culture']): ?>selected="selected"<?php endif ?>
            ><?php echo $culture; ?></option>
        <?php endforeach ?>
    </select>    
	<input type="submit" value="Clear" name="clear_on_any_change_submit" /> 	
</form>
<br/>

<form action="" method="post" >
    Path: <input type="text" name="path" value="<?php if (!empty($_POST['path'])): echo $_POST['path']; endif; ?>" size="100"/>     
    <input type="checkbox" <?php if (empty($_POST['path']) || !empty($_POST['al_cultures'])): ?>checked="checked"<?php endif ?> name="al_cultures" /> All cultures
	<input type="submit" value="Delete" name="clear" /> 
	<input type="submit" value="Restore" name="restore" />
</form>
<?php if (!empty($clear_pathes)): ?>
Cleared: <?php echo count($clear_pathes); ?><br/>
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