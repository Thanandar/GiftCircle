<div class="span16">
   <h3>Confirmation</h3>
<?php

echo Form::open('user/unregister/'.$id, array('style' => 'display: inline;'));

echo Form::hidden('id', $id);

echo '<p>Are you sure you want to continue? <strong>There is no undo.</strong></p>';

?>
<input type="hidden" name="confirmation" value="Y" />

<div class="well">

<?php

echo Form::submit(NULL, 'I am sure', array('class'=>'btn danger'));
echo Form::close();

echo Form::open('user/profile', array('style' => 'display: inline; padding-left: 10px;'));
?>
or
<a href="/">cancel</a>
<?php 

echo Form::close();
?>
</div>

</div>