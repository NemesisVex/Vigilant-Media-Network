<aside id="frame-1" class="span-6 prepend-1 append-1 prepend-top">
	<h3>Contact</h3>

	<p>To reach <strong>GREG BUENO</strong>, please fill out this form.</p>
</aside>

<section id="frame-2" class="span-14 prepend-top box last">

	<form method="post" action="/index.php/vm/email/" id="contact" name="contact">

		<p>
			<label for="i">Name:</label>
			<input type="text" name="i" id="i" size="55" class="form_hidden" />
			<input type="text" name="n" id="n" size="55" />
		</p>

		<p>
			<label for="s">E-mail:</label>
			<input type="text" name="s" id="s" size="55" class="form_hidden" />
			<input type="text" name="a" id="a" size="55" />
		</p>

		<p>
			<label for="r">Subject:</label>
			<input type="text" name="r" id="r" size="55" class="form_hidden" />
			<input type="text" name="t" id="t" size="55" />
		</p>

		<p>
			<label for="m">Comments:</label>
			<textarea cols="75" rows="10" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
			<textarea cols="75" rows="10" name="b" id="b" wrap="soft"></textarea>
		</p>

		<p>
			<label>&nbsp;</label>
			<input type="submit" value="Send" />
			<input type="reset" value="Reset" />
		</p>
	</form>

	<script type="text/javascript" src="{$config.to_vigilante}/includes/jquery.validate.pack.js"></script>
{literal}
	<script type="text/javascript">
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
	</script>
{/literal}

</section>
