<p>You are logged in as <strong>{$rsUser->user_login}</strong>. [<a href="/index.php/members/edit/{$user_id}/">Edit</a>]</p>

<p>
	<label>Login:</label>
{$rsUser->user_login}
</p>

<p>
	<label>Name:</label>
{$rsUser->user_first_name} {$rsUser->user_last_name}
</p>

<p>
	<label>E-mail:</label>
{$rsUser->user_email}
</p>

<p>
	<label>URL:</label>
	<a href="{$rsUser->user_url}">{$rsUser->user_url}</a>
</p>

<p>
	<label>City:</label>
{$rsUser->user_city}
</p>

<p>
	<label>State:</label>
{$rsUser->user_state}
</p>

<p>
	<label>Country:</label>
{$rsUser->user_country}
</p>

<p>
	<label>Birthdate:</label>
	<strong>{$rsUser->user_birthdate|date_format:"%m/%d/%Y"}</strong>
</p>


<p>[<a href="/index.php/members/logout/">Logout</a>]</p>
