<!doctype html>
<html lang="<?php echo I18n::$lang ?>" class="<?php echo HTML::chars($controller.'-'.$action) ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<title><?php echo $title ?> &mdash; Gift Circle</title>
<?php if ($metakeywords) { ?>
	<meta name="keywords" content="<?php echo HTML::chars($metakeywords) ?>">
<?php } ?>
	<link href="/favicon.ico" rel="shortcut icon" />
<?php foreach ($styles as $file => $type) echo "\t" . HTML::style($file, array('media' => $type)), PHP_EOL ?>
	<!--[if IE 7]><link rel="stylesheet" href="/static/css/ie7styles.css" type="text/css" /><![endif]-->
<?php foreach ($scripts as $file) echo "\t" . HTML::script($file), PHP_EOL ?>
<script type="text/javascript">
var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-26418668-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
</script>
<!-- TradeDoubler site verification 1992396 -->
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
					<a href="/user/profile_edit"><strong><?php echo $name; ?></strong></a>
				</span>&nbsp;
			</div>
		<?php } 
		
			if (!empty($is_home)) { 
			?>
			<h1 class="homeh1"><?php echo $title ?></h1>
			<?php 
			} else {
			?>
			<h1 class="title"><?php echo $title ?></h1>
			<?php 
			}
			if (!empty($subtitle)) { ?>
			<h2>
				<?php echo $subtitle ?>
			</h2>
		<?php } ?>

		<?php if (!empty($post_header)) { echo $post_header; } ?>

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
		<p>
			&copy; 2011 Net Optimisers Ltd

			| <a href="/home/company_info">Company Info</a>

			| <a href="/home/terms">Terms &amp; Conditions</a>

			| <a href="/home/privacy">Privacy Policy</a>

			| <a href="/home/contact">Contact us</a>

			| <a href="/home/partner">Partner with us</a>

		</p>
	</div>
</div>

<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
</body>
</html>
