
<div class="span16">
<?php
echo Form::open('user/forgot');
echo '<p>'.__('Your email address:').' '.Form::input('reset_email', '', array('class' => 'text')).'</p>';
?>

<?php
echo Form::submit(NULL, __('Reset password'));
echo Form::close();
?>
</div>
