<div class="span16">
<?php
echo Form::open('user/reset');
?>
   <fieldset>
         <div class="clearfix">
            <label><?php echo __('Email address'); ?></label>
            <div class="input"><?php echo Form::input('reset_email', @$_GET['reset_email']); ?></div>
         </div>
         <div class="clearfix">
            <label><?php echo __('Password reset token'); ?></label>
            <div class="input"><?php echo Form::input('reset_token', @$_GET['reset_token']); ?></div>
         </div>
   

         <div class="actions">
            <input type="submit" value="Reset password" class="btn primary large" />
         </div>

   </fieldset>


<?php echo Form::close() ?>

</div>