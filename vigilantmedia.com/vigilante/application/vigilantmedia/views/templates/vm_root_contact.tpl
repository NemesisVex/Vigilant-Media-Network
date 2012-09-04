				<div class="full-column-last">

					<form method="post" action="/index.php/vm/email/" id="contact-form" name="contact-form">
						<h1>Contact</h1>

						<p>
							<label for="i">Name:</label>
							<input type="text" name="i" id="i" size="55" class="form-hidden" />
							<input type="text" name="n" id="n" size="55" />
						</p>

						<p>
							<label for="s">E-mail:</label>
							<input type="text" name="s" id="s" size="55" class="form-hidden" />
							<input type="text" name="a" id="a" size="55" />
						</p>

						<p>
							<label for="r">Subject:</label>
							<input type="text" name="r" id="r" size="55" class="form-hidden" />
							<input type="text" name="t" id="t" size="55" />
						</p>

						<p>
							<label for="m">Comments:</label>
							<textarea cols="75" rows="10" name="m" id="m" wrap="soft" class="form-hidden"></textarea>
							<textarea cols="75" rows="10" name="b" id="b" wrap="soft"></textarea>
						</p>

						<p>
							<label>&nbsp;</label>
							<input type="submit" value="Send" />
							<input type="reset" value="Reset" />
						</p>
					</form>
				</div>

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
