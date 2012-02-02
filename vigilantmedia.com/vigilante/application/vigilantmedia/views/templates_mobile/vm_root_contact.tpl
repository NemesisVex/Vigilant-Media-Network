<aside id="frame-1" class="prepend-1 append-1 prepend-top">
	<h3>Contact</h3>

	<p>To reach <strong>GREG BUENO</strong>, please fill out this form.</p>
</aside>

<section id="frame-2" class="prepend-top box last">

	<form method="post" action="/index.php/vm/email/" id="contact" name="contact">

		<p>
			<label for="i">Name:</label>
			<input type="text" name="i" id="i" class="form_hidden" />
			<input type="text" name="n" id="n" />
		</p>

		<p>
			<label for="s">E-mail:</label>
			<input type="text" name="s" id="s" class="form_hidden" />
			<input type="text" name="a" id="a" />
		</p>

		<p>
			<label for="r">Subject:</label>
			<input type="text" name="r" id="r" class="form_hidden" />
			<input type="text" name="t" id="t" />
		</p>

		<p>
			<label for="m">Comments:</label>
			<textarea rows="10" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
			<textarea rows="10" name="b" id="b" wrap="soft"></textarea>
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
