				<div id="column-1" class="span-15 append-1">

					<header>
						<h2>Contact</h2>
					</header>

					<form action="/index.php/observant/email/" method="post" id="contact" name="contact">
						<p>
							<label for="n">Name:</label>
							<input type="text" name="i" id="i" size="50" class="form_hidden" />
							<input type="text" name="n" id="n" size="50" />
						</p>

						<p>
							<label for="a">E-mail:</label>
							<input type="email" name="s" id="s" size="50" class="form_hidden" />
							<input type="email" name="a" id="a" size="50" />
						</p>

						<p>
							<label for="t">Subject:</label>
							<input type="text" name="r" id="r" size="50" class="form_hidden" />
							<input type="text" name="t" id="t" size="50" />
						</p>

						<p>
							<label for="b">Comments:</label>
							<textarea cols="40" rows="7" name="m" id="m" wrap="soft" class="form_hidden"></textarea>
							<textarea cols="40" rows="7" name="b" id="b" wrap="soft"></textarea>
						</p>

						<p>
							<input type="submit" id="send" value="Send" class="form_button" />
							<input type="reset" id="reset" value="Reset" class="form_button" />
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

				</div>

				<div id="column-2" class="span-8 last">
				</div>
