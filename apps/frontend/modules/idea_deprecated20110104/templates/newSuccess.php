<?php slot('body_id') ?>body_idea<?php end_slot() ?>
<h1><?php echo __('Idea of the Week') ?></h1>
<h2><?php echo __('My') ?></h2>

<p>
	<?php echo __("Please read the") ?> <a href="<?php echo url_for('@idea_ideaoftheweek', true); ?>"><?php echo __("rules") ?></a> <?php echo __("before creation.") ?>
	<?php echo __("You can create new Idea only once a week and you can't edit your Idea after creation.") ?>
</p>

<?php if ($preview_idea): ?>
	<?php include_partial( 'idea/show', array('idea'=>$preview_idea, 'noLinks'=>true, 'short'=>false) ); ?>
	<br/>
<?php endif ?>

<div class="idea_form">
	<script type="text/javascript">
		$(document).ready(function() {
			$("#idea_form").validate({
						rules: {
							"idea[body]": "required"
						},
						messages: {
							"idea[body]": ""
						}
			});
		});
	</script>
	<form action="" method="post"id="idea_form">
	<p class="no_decor">
		<textarea name="idea[body]" rows="10" cols="88"><?php echo $_POST['idea']['body']; ?></textarea>
	</p>
	<p class="p1 no_decor">
		<?php if ($error_idea): ?>
			<span class="error_list"><?php echo __('Please enter an Idea') ?></span><br/>
		<?php endif ?>
		<?php if ($error_post): ?>
			<span class="error_list"><?php echo __('Error occured creating an Idea') ?></span><br/>
		<?php endif ?>
		<input type="submit" value="<?php echo __('Preview') ?>" class="input_submit" name="preview"/>&nbsp;&nbsp;&nbsp;
		<input type="submit" value="<?php echo __('Create') ?>" class="input_submit"/>
	</p>
	</form>
</div>