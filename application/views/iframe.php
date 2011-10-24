<!doctype html>
<html lang="<?php echo I18n::$lang ?>" class="iframe">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<title>Gift Circle</title>
<?php foreach ($styles as $file => $type) echo "\t" . HTML::style($file, array('media' => $type)), PHP_EOL ?>
	<!--[if IE 7]><link rel="stylesheet" href="/static/css/ie7styles.css" type="text/css" /><![endif]-->
<?php foreach ($scripts as $file) echo "\t" . HTML::script($file), PHP_EOL ?>
<?php if (!empty($_GET['u'])) { ?>
<script>
var url = <?php echo json_encode($_GET['u']); ?>;

</script>
<?php } ?>
<script>

function close_iframe() {
	var u = (window.url || '').replace(/#.*/, '');
	window.parent.location = u ? u + '#GCclose' : window.parent.location;
}

</script>
<script type="text/javascript">
var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-26418668-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();
</script>
</head>
<body>


<div class="topbar">
	<div class="fill">
		<div class="container">
			
        	<span class="brand" style="padding-left: 20px">
        		
        		<img alt="Gift Circle" src="/img/logo.png" class="brand">
        	</span>

        	<div class="pull-right">
        		<form>
        			<p>

						<?php 
						if (Auth::instance()->logged_in()) { 

							$user = Auth::instance()->get_user();
							$name = htmlspecialchars($user->firstname . ' ' . $user->surname);
							if (!strlen(trim($name))) {
								$name = $user->email;
							}
						?>
								<span class="currently-logged-in">Logged in as 
									<strong><?php echo $name; ?></strong>
								</span>&nbsp;
        						<button class="btn" type="button" onclick="window.parent.location='http://'+location.hostname+'/user/logout'">Logout</button>
						<?php } ?>

        				<button class="btn" type="button" onclick="window.parent.location='http://'+location.hostname">Go to Gift Circle</button>
        				<button class="btn" type="button" onclick="close_iframe()">Close</button>
        				&nbsp;&nbsp;
        			</p>
        		</form>
        	</div>


		</div>
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

<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

</body>
</html>
