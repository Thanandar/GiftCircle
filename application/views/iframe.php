<!doctype html>
<html lang="<?php echo I18n::$lang ?>" class="iframe">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<title>Gift Circle</title>
<?php foreach ($styles as $file => $type) echo "\t" . HTML::style($file, array('media' => $type)), PHP_EOL ?>
	<!--[if IE 7]><link rel="stylesheet" href="/static/css/ie7styles.css" type="text/css" /><![endif]-->
<?php foreach ($scripts as $file) echo "\t" . HTML::script($file), PHP_EOL ?>
<?php if (!empty($_COOKIE['bmu'])) { ?>
<script>
var url = <?php echo json_encode($_GET['u']); ?>;

</script>
<?php } ?>
<script>

function close_iframe() {
	var u = (window.url || '').replace(/#.*/, '');
	if (u) {
		window.parent.location = u + '#GCclose';
	} else {
		
	}
}

</script>
<script type="text/javascript">
var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-26418668-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
</script>
</head>
<body>


<!-- <div class="topbar">
	<div class="fill">
		<div class="container">
			
        		<a href="/" target="_top" class="brand" >
        		
        		<img alt="Gift Circle" src="/img/logo-beta.png" class="brand">
        	</a>



		</div>
	</div>
</div> -->



<div class="container content-container">
	<div class="content">

		<?php 
		if (Auth::instance()->logged_in()) { 

			$user = Auth::instance()->get_user();
			$name = htmlspecialchars($user->firstname . ' ' . $user->surname);
			if (!strlen(trim($name))) {
				$name = $user->email;
			}
		?>
		<span class="currently-logged-in">
			Logged in as 
			<strong><?php echo $name; ?></strong>
			|	
				<a href="/user/logout" target="_top">Logout</a>
		</span>
		<?php } ?>

		<?php echo Message::output(); ?>
		<div class="row">
<!-- end of header -->


<?php echo $content ?>


<!-- footer -->
		</div><!-- .row -->
	</div><!-- .content -->
</div><!-- .container -->


<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

</body>
</html>
