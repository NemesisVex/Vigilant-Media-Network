<p>
To reach Austin Stories, fill out this form.
</p>

<form method="post" action="{if $action}{$action}{else}/index.php/aus/email/{/if}" id="contact" name="contact">

<p>
<label for="n">Name:</label>
<input type="text" name="i" id="i" size="55" class="form_hidden">
<input type="text" name="n" id="n" size="55"><br clear="left">
</p>

<p>
<label for="n">E-mail:</label>
<input type="text" name="s" id="s" size="55" class="form_hidden">
<input type="text" name="a" id="a" size="55"><br clear="left">
</p>

<p>
<label for="n">Subject:</label>
<input type="text" name="r" id="r" size="55" class="form_hidden">
<input type="text" name="t" id="t" size="55">
</p>

<p>
<label for="m">Comments:</label>
<textarea cols="75" rows="10" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
<textarea cols="75" rows="10" name="b" id="b" wrap="soft"></textarea><br clear="left">
</p>

<p>
<label for="send">&nbsp;</label>
<input type="submit" id="send" value="Send" class="form_button">
<input type="reset" id="reset" value="Reset" class="form_button">
</p>
</form>

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
