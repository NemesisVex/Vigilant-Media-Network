<form action="/index.php/ep4/email/" method="post" id="contact" name="contact">
<p>Recordings are released through <strong>Observant Records</strong>.</p>

<p>Publishing is administered by <strong>Shinkyoku Advocacy</strong> (ASCAP).</p>

<p>Eponymous 4, Observant Records and Shinkyoku Advocacy can all be reached through this form. (Pretty much, they're all the same person.)</p>

<p>
<label for="n">Name:</label>
<input type="text" name="i" id="i" class="form_hidden">
<input type="text" name="n" id="n">
</p>

<p>
<label for="n">E-mail:</label>
<input type="email" name="s" id="s" class="form_hidden">
<input type="email" name="a" id="a">
</p>

<p>
<label for="n">Subject:</label>
<input type="text" name="r" id="r" class="form_hidden">
<input type="text" name="t" id="t">
</p>

<p>
<label for="m">Comments:</label>
<textarea rows="7" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
<textarea rows="7" name="b" id="b" wrap="soft"></textarea>
</p>

<p>
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
