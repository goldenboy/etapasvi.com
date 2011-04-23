<?php include_partial('user/login', array('form_action'=>url_for('@user_login'), 'from'=>$from) ); ?>
<p class="p1">
    <a href="<?php echo url_for('@user_signup', true); ?>" title="<?php echo __('Sign up') ?>"><?php echo __('Sign up') ?></a>
</p>