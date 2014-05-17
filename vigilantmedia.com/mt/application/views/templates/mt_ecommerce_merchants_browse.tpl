<h4 class="admin_head">Edit a merchant</h4>

<p>
{foreach item=rsMerchant from=$rsMerchants}
[<a href="/index.php/ecommerce/merchants/edit/{$rsMerchant->merchant_id}/">Edit</a>]
[<a href="/index.php/ecommerce/merchants/delete/{$rsMerchant->merchant_id}/">Delete</a>]
<strong>{$rsMerchant->merchant_name}</strong><br>
{/foreach}
</p>

<form action="/index.php/ecommerce/merchants/create/" method="post">

<div class="AdminHead">Add a merchant</em></div><br>

<table class="Admin">
<tr>
	<td valign="top">E-commerce site:</td>
	<td valign="top"><font size=2><input type="text" name="merchant_name" size=40></font></td>
</tr>
<tr>
	<td valign="top">URL template for links:</td>
	<td valign="top"><font size=2><input type="text" name="merchant_url" size=40></font></td>
</tr>
<tr>
	<td valign="top">Image URL to track impressions:</td>
	<td valign="top"><font size=2><input type="text" name="merchant_url_image" size=40></font></td>
</tr>
</table>

<p>
<input type="submit" value="Add merchant">
</p>

</form>
