				<div id="column-1">

					<header>
						<h2>Contact</h2>
					</header>

					<form action="/index.php/ep4/email/" method="post" id="contact" name="contact">
						<p>
							<label for="n">Name:</label>
							<input type="text" name="i" id="i" size="40" class="form_hidden" />
							<input type="text" name="n" id="n" size="40" />
						</p>

						<p>
							<label for="a">E-mail:</label>
							<input type="email" name="s" id="s" size="40" class="form_hidden" />
							<input type="email" name="a" id="a" size="40" />
						</p>

						<p>
							<label for="t">Subject:</label>
							<input type="text" name="r" id="r" size="40" class="form_hidden" />
							<input type="text" name="t" id="t" size="40" />
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

				<div id="column-2">
					<h3>More ways to get in touch</h3>
					
					<ul>
						<li> <a href="http://www.facebook.com/eponymous4">Facebook</a></li>
						<li> <a href="http://twitter.com/eponymous4">Twitter</a></li>
					</ul>
				</div>
