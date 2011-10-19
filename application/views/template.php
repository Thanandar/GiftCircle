<!doctype html>
<html lang="<?php echo I18n::$lang ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?> &mdash; GiftCircle</title>
<?php foreach ($styles as $file => $type) echo "\t" . HTML::style($file, array('media' => $type)), PHP_EOL ?>
<?php foreach ($scripts as $file) echo "\t" . HTML::script($file), PHP_EOL ?>
<!-- IE7 Stylesheet -->
<!--[if IE 7]>
<link rel="stylesheet" href="/static/css/ie7styles.css" type="text/css" />
<![endif]-->
<!-- Hack to fix <footer> on IE's older than 9 -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<?php echo View::factory('page/menu'); ?>

<div class="page-header">
	<div class="container">
		<?php 
		if (Auth::instance()->logged_in()) { 

			$user = Auth::instance()->get_user();
			$name = htmlspecialchars($user->firstname . ' ' . $user->surname);
			if (!strlen(trim($name))) {
				$name = $user->email;
			}
		?>
			<div class="pull-right">
				<span class="currently-logged-in">Logged in as 
					<a href="/user/profile"><strong><?php echo $name; ?></strong></a>
				</span>&nbsp;
			</div>
		<?php } ?>

		<h1>
			<?php echo $title ?>
		</h1>
		<?php if (!empty($subtitle)) { ?>
			<h2>
				<?php echo $subtitle ?>
			</h2>
		<?php } ?>

	</div>
</div>

<div class="container content-container">
	<div class="content">
		<?php echo Message::output(); ?>
		<div class="row">
<!-- end of header -->


<?php echo $content ?>



<!-- footer -->
		</div><!-- .row -->
	</div><!-- .content -->
</div><!-- .container -->

<div class="footer">
	<div class="container">
		<p>&copy; 2011 Net Optimisers Ltd</p>
	</div>
</div>

</body>
</html>
