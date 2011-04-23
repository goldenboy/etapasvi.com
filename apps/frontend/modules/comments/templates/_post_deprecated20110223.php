<?php /*
<?php use_helper('Form'); ?>
<div class="comments_form">
    <script type="text/javascript" src="/js/jquery.textarearesizer.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
            $("#post_comment_btn").removeAttr("disabled");
			$("#comments_form").validate({
                submitHandler: function(form) {
                    $("#post_comment_btn").attr("disabled", "disabled");
                    $("#post_comment_loader").show();
                    form.submit();
                },
                rules: {
                    "comments[body]": "required"
                },
                messages: {
                    "comments[body]": ""
                }
			});
			$(".comments_form textarea").TextAreaResizer();
		});
	</script>
	<form action="<?php echo $_SERVER['SCRIPT_URI'] . '#comments' ?>" method="post" id="comments_form">
	<p class="no_decor">
		<strong><?php echo __('Add comment') ?></strong>
		<textarea name="comments[body]" rows="5" ><?php /*echo $_POST['comments']['body'];* ?></textarea>
	</p>
	<p class="p1 no_decor">
		<?php if (!empty($error_comments)): ?>
			<span class="error_list"><?php echo __('Please enter comment') ?></span><br/>
		<?php endif ?>
		<?php if (!empty($error_post)): ?>
			<span class="error_list"><?php echo __('Error occurred posting comment') ?></span><br/>
		<?php endif ?>
		<input type="submit" value="<?php echo __('Post') ?>" class="input_submit" id="post_comment_btn"/> <img src="/images/ajax_loader.gif" id="post_comment_loader" class="hidden"/>
	</p>
	</form>
</div>
*/?>