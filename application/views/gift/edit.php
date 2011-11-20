
<div class="span12">

	<h3><?php echo HTML::chars($gift->name); ?></h3>

	<div class="alert-message warning">
		<p>Someone may have reserved or bought this gift.</p>
	</div>

	<form method="post">
		<fieldset>
			<div class="clearfix<?php if (!empty($errors['name'])) {echo ' error';} ?>">
				<label>Title: </label>
				<div class="input">
					<input name="name" value="<?php echo HTML::chars($gift->name); ?>">
					<?php if (!empty($errors['name'])) {
						echo '<span class="help-inline">' . $errors['name'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix<?php if (!empty($errors['cat'])) {echo ' error';} ?>">
				<label>Category: </label>
				<div class="input">
					<?php
					Arr::unshift($categories, '', 'Please select&hellip;');
					echo Form::select('category_id', $categories, $gift->category_id);
					?>
					<?php if (!empty($errors['cat'])) {
						echo '<span class="help-inline">' . $errors['cat'] . '</span>';
					} ?>
				</div>
			</div>
			<div class="clearfix">
				<label>&pound;Guide: </label>
				<div class="input">
					<div class="input-prepend">
						<span class="add-on">&pound;</span>
						<input name="price" value="<?php echo HTML::chars($gift->price); ?>">
						<span class="help-inline">Optional</span>					
					</div>
				</div>
			</div>
			<div class="clearfix">
				<label>Link: </label>
				<div class="input">
					<input placeholder="http://" name="url" value="<?php echo HTML::chars($gift->url) ?>">
					<span class="help-inline">Optional</span>
				</div>
			</div>			
			<div class="clearfix">
				<label>Description: </label>
				<div class="input">
					<textarea class="xlarge" rows="3" name="details" placeholder="e.g. Don't mind the colour, as long as they have the powerlaces."><?php echo HTML::chars($gift->details) ?></textarea>
					<span class="help-inline">Optional</span>
				</div>
			</div>			


			<div class="actions">
				<input type="submit" value="Update gift" class="btn primary" /> or
				<a href="/list/mine/<?php echo $gift->list->id; ?>">cancel</a>
			</div>
		</fieldset>
	</form>



</div>

<div class="span4">
	<h3>On your list</h3>
	<table class="zebra-striped">
		<thead>
			<tr>
				<th width="180">Gift name</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($other_gifts as $other_gift) { ?>
			<tr>
				<td><a href="/gift/edit/<?php echo $other_gift->id; ?>"><?php echo $other_gift->name; ?></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="well">
		<a class="btn" href="/list/mine/<?php echo $gift->list->id; ?>">Manage list</a>
	</div>
</div>




