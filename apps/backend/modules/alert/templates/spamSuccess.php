<?php if ($msg): ?>
	<font color="red"><?php echo $msg ?></font><br/><br/>
<?php endif ?>

<form action="" method="post" >

	<input type="radio" name="item_type" value="<?php echo ItemtypesPeer::ITEM_TYPE_NEWS ?>" checked="checked"/> 
	<?php echo ItemtypesPeer::ITEM_TYPE_NAME_NEWS ?>
	 
	<select name="news_id" >
	<?php foreach($news_list as $news): ?>
		<option value="<?php echo $news->getId(); ?>"><?php echo $news->getId(); ?> - <?php echo $news->getTitle(); ?></option>
	<?php endforeach ?>
	</select>

	<br/><br/>
	<input type="radio" name="item_type" value="<?php echo ItemtypesPeer::ITEM_TYPE_PHOTO ?>"/> 
	<?php echo ItemtypesPeer::ITEM_TYPE_NAME_PHOTO ?>
	 
	<select name="photo_id" >
	<?php foreach($photo_list as $photo): ?>
		<option value="<?php echo $photo->getId(); ?>"><?php echo $photo->getId(); ?> - <?php echo $photo->getTitle(); ?></option>
	<?php endforeach ?>
	</select>

	<br/><br/>
	<input type="radio" name="item_type" value="<?php echo ItemtypesPeer::ITEM_TYPE_VIDEO ?>"/> 
	<?php echo ItemtypesPeer::ITEM_TYPE_NAME_VIDEO ?>
    
	<select name="video_id" >
	<?php foreach($video_list as $video): ?>
		<option value="<?php echo $video->getId(); ?>"><?php echo $video->getId(); ?> - <?php echo $video->getTitle(); ?></option>
	<?php endforeach ?>
	</select>
    
	<br/><br/>
	<input type="radio" name="item_type" value="<?php echo ItemtypesPeer::ITEM_TYPE_MAIL ?>"/> 
	<?php echo ItemtypesPeer::ITEM_TYPE_NAME_MAIL ?>
    
	<select name="mail_id" >
	<?php foreach($mail_list as $mail): ?>
		<option value="<?php echo $mail->getId(); ?>"><?php echo $mail->getId(); ?> - <?php echo $mail->getTitle(); ?></option>
	<?php endforeach ?>
	</select>
	
    <br/><br/>
    Users (login/email):<br/>
    <textarea cols="50" rows="5" name="user_names"></textarea>
    <input type="checkbox" name="user_exclude" value="Y"/> Exclude
    
	<br/><br/>
	<input type="submit" value="Spam" name="spam"/>&nbsp;&nbsp;&nbsp;
	<input type="submit" value="Undo" name="undo"/>
</form>