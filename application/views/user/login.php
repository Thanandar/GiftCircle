<?php echo View::factory('page/header'); ?>


<h2>Login</h2>
<form method="post">
	<label>Email <input name="email"></label>
	<label>Password <input name="password" type="password"></label>
	<input type="submit" value="Login" />
</form>


<?php
if (!empty($errors)) {
	echo $errors;
}
?>

<?php echo View::factory('page/footer'); ?>
