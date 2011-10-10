<!doctype html>
<html lang="<?php echo I18n::$lang ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?> &mdash; GiftCircle</title>
<?php foreach ($styles as $file => $type) echo "\t" . HTML::style($file, array('media' => $type)), PHP_EOL ?>
<?php foreach ($scripts as $file) echo "\t" . HTML::script($file), PHP_EOL ?>
</head>
<body>

<?php echo View::factory('page/menu'); ?>

<div class="container">
	<div class="content">
		<div class="page-header">
			<h1>
				<img src="http://placehold.it/80x50&text=Logo" alt="Logo" style="vertical-align:middle" />
				<?php echo $title ?>
				<small>Gift Circle</small>
			</h1>
		</div>
		<?php echo Message::output(); ?>
		<div class="row">
<!-- end of header -->


<?php echo $content ?>



<!-- footer -->
		</div><!-- .row -->
	</div><!-- .content -->
	<footer>
		<p>&copy; 2011 GiftCircle Ltd</p>
	</footer>
</div><!-- .container -->

</body>
</html>
