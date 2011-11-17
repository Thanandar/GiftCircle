
<div class="span12">
<?php
echo Form::open('user/forgot');
echo '<p>'.__('Enter your email address:').' '.Form::input('reset_email', '', array('class' => 'text')).'</p>';
?>

<div class="well">
<?php
echo Form::submit(NULL, __('Send confirmation'), array('class'=>'primary btn'));

?>
</div>
<?php

echo Form::close();
?>
</div>
