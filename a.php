<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
	<style>html, body{margin:0,padding:0;border:0;} body{padding-top: 40px; } .container {width: auto;}</style>
</head>
<body>

<div class="topbar">
	<div class="topbar-inner">
		<div class="container">
			<h3><a href="#">&nbsp;GiftCircle</a></h3>
			<form class="pull-right">
				<button class="btn" type="button" onclick="window.parent.location.hash='#GCclose'">Close</button>
				&nbsp;
			</form>
		</div>
	</div>
</div>

<?php if (strpos(@$_GET['u'], 'gift-circle')) { ?>

<p>
	<br />
	<br />
	The bookmark works!
	<button class="btn" type="button" onclick="window.parent.location.hash='#GCclose'">Close</button> this popup and browse for gifts to add.
</p>

<?php } else { ?>


<form method="post">
	<fieldset>

		<div class="clearfix">
			<label>Choose a list: </label>
			<div class="input">
				<select name="category_id">

					<option value="">&mdash; SELECT &mdash;</option>
						<option>Birthday</option>
						<option>Christmas</option>
					</select>				
				</div>
			</div>


		<div class="clearfix">
			<label>Product Title: </label>
			<div class="input">
				<input name="name">

								</div>
		</div>
		<div class="clearfix">
			<label>Product Price: </label>
			<div class="input">
				<div class="input-prepend">
					<span class="add-on">&pound;</span>
					<input name="price">

					<span class="help-inline">Optional</span>					
				</div>
			</div>
		</div>
		<div class="clearfix">
			<label>Product Category: </label>
			<div class="input">
				<select name="category_id">

<option value="">&mdash; SELECT &mdash;</option>
<option value="1">Baby </option>
<option value="2">Beauty </option>
<option value="3">Books </option>
<option value="4">Car &amp; Motorbike </option>
<option value="5">Classical </option>
<option value="6">Clothing </option>

<option value="7">Computers &amp; Accessories </option>
<option value="8">DIY &amp; Tools </option>
<option value="9">Electronics &amp; Photo </option>
<option value="10">Film &amp; TV </option>
<option value="11">Garden &amp; Outdoors </option>

<option value="12">Grocery </option>
<option value="13">Health &amp; Beauty </option>
<option value="14">Jewellery </option>
<option value="15">Kitchen &amp; Home </option>
<option value="16">Lighting </option>
<option value="17">MP3 Downloads </option>
<option value="18">Music </option>

<option value="19">Musical Instruments &amp; DJ </option>
<option value="20">PC &amp; Video Games </option>
<option value="21">Pet Supplies </option>
<option value="22">Shoes &amp; Accessories </option>
<option value="23">Software </option>
<option value="24">Sports &amp; Leisure </option>

<option value="25">Stationery &amp; Office Supplies </option>
<option value="26">Toys &amp; Games </option>
<option value="27">Watches</option>
</select>				</div>
		</div>
		<div class="clearfix">
			<label>Product Link: </label>

			<div class="input">
				<input name="url" value="<?php echo htmlspecialchars(@$_GET['u']) ?>">
				<span class="help-inline">Optional</span>
			</div>
		</div>
		<div class="clearfix">
			<label>Product Description: </label>
			<div class="input">

				<textarea class="xxlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."></textarea>
				<span class="help-inline">Optional</span>
			</div>
		</div>	

		<div class="actions">
			<input type="submit" value="Add item" class="btn primary" /> or
			<a href="javascript:window.parent.location.hash='#GCclose'">cancel</a>
		</div>

	</fieldset>
</form>

<?php } ?>

</pre>
</body>
</html>

