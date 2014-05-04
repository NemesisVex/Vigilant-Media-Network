<section class="full-column">
{if $session->flashget('error')}{catch_error error=$session->flashget('error') color=#F99}{/if}
{if $session->flashget('msg')}{catch_message msg=$session->flashget('msg') color=#CCF}{/if}

	<form action="/index.php/members/generate_password/" method="post">
		<p>If you've forgotten your password, you can create a new one. Enter the e-mail address you used to set up your account.</p>

		<p>
			<label for="email">Your email address:</label>
			<input type="text" id="email" name="email" size="40" />
		<p>
			<input type="submit" value="Send" />
		</p>

	</form>

</section>