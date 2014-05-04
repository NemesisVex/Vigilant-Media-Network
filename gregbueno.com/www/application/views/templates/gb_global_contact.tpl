<form method="post" action="{if $action}{$action}{else}/index.php/gb/email/{/if}" id="contact" name="contact">

	<p>
		<label for="n">Name:</label>
		<input type="text" name="i" id="i" size="40" class="form_hidden">
		<input type="text" name="n" id="n" size="40">
	</p>

	<p>
		<label for="n">E-mail:</label>
		<input type="email" name="s" id="s" size="40" class="form_hidden">
		<input type="email" name="a" id="a" size="40">
	</p>

	<p>
		<label for="n">Subject:</label>
		<input type="text" name="r" id="r" size="40" class="form_hidden">
		<input type="text" name="t" id="t" size="40">
	</p>

	<p>
		<label for="m">Comments:</label>
		<textarea cols="55" rows="10" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
		<textarea cols="55" rows="10" name="b" id="b" wrap="soft"></textarea>
	</p>

	<p>
		<label for="send">&nbsp;</label>
		<input type="submit" id="send" value="Send">
		<input type="reset" id="reset" value="Reset">
	</p>
</form>

<script type="text/javascript" src="{$smarty.const.VIGILANTMEDIA_CDN_BASE_URI}/js/jquery.validate.pack.js"></script>
<script type="text/javascript">
	{literal}
$(document).ready(function ()
{
	$('#contact').validate(
	{
		rules:
		{
			n: {required: true},
			a: {required: true, email: true},
			b: {required: true}
		},
		messages:
		{
			n: {required: 'Please provide your name'},
			a: {required: 'Please provide your e-mail address'},
			b: {required: "Aren't you going to say something?"}
		}
	});
});
	{/literal}
</script>
