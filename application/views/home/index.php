
<div class="span16">

	<a href="/user/register" class="btn-start"><img src="/img/buttons/home-get-started.png" width="336" height="48" alt="Get started in 30 seconds flat"></a>

<script type="text/javascript" src="/static/swf/swfobject.js"></script>
<script type="text/javascript">

	var flashvars = {
		config_file: "/static/swf/countdown_flip_config.xml"
	};

	var params = {
		bgcolor: "ffffff",
		menu: "false",
		quality: "high",
		scale: "scale"
	};

	var attributes = {
		id: "swf_content",
		name: "swf_content"
	};

	swfobject.embedSWF("/static/swf/countdown_flip_2days.swf", "flashcontent", "388", "74", "8.0.0", false, flashvars, params, attributes);

</script>
<link rel="stylesheet" type="text/css" href="/static/swf/_styles/main.css" />

	<div id="countdown">
        <img src="/img/shopping-time-left.png" height="23" alt="Christmas shopping time left..."><br />
        <div id="flashcontent">
            <div id="altcontent">
<?php

  $day   = 19;     // Day of the countdown
  $month = 12;      // Month of the countdown
  $year  = 2011;   // Year of the countdown
  $hour  = 23;     // Hour of the day (east coast time)

  $calculation = ((mktime ($hour,0,0,$month,$day,$year) - time())/3600);
  $hours = (int)$calculation;
  $days  = (int)($hours/24);
?>
                <span><?php print $days; ?></span> days left!
            </div>
        </div>
	</div>

</div>

<div class="span16">


	<h4>
		Why Gift Circle is just what you need for Christmas&hellip;
	</h4>

	<div class="row home-list">
		<div class="span8">
			<ol>
				<li>
					<h4>Find out what friends &amp; family really want</h4>
					<p>Create your circle and invite them to let you know what they really want for Christmas.</p>
				</li>
				<li>
					<h4>Let them know what you want</h4>
					<p>Create your own gift list to get the gifts you really do want</p>
				</li>
				<li>
					<h4>Avoid spending too much</h4>
					<p>Knowing what your circle wants will help you to spend just what's needed to make their day. </p>
				</li>
				<li>
					<h4>Never forget anyone again</h4>
					<p>Ever got too close to the day and realised you've left out someone important? Gift Circle will help jog your memory.</p>
				</li>
			</ol>
		</div>
		<div class="span8">
			<ol class="right">
				<li>
					<h4>Everything is kept within your circle</h4>
					<p>A secure circle of friends and family where gift ideas and contact information can be exchanged in private.</p>
				</li>
				<li>
					<h4>Choose gifts without spoiling the surprise</h4>
					<p>Add more gifts to your list than folks in your circle. That way there's plenty to choose from without spoiling the surprise.</p>
				</li>
				<li>
					<h4>Save money by keeping to your budget</h4>
					<p>Don't get carried away with your spending. Keep a check on your finances with our built in shopping list manager.</p>
				</li>
				<li>
					<h4>Create wish lists for your children</h4>
					<p>Securely create lists on behalf of and with your children to share with all their aunties, uncles and grandparents.</p>
				</li>
			</ol>
		</div>
	</div>

</div>


