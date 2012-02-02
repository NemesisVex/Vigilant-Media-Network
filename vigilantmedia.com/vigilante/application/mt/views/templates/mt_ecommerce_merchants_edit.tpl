<h4 class="admin_head">Edit a merchant</h4>

<form action="/index.php/ecommerce/merchants/update/{$merchant_id}/" method="post" name="merchant">

<table class="Admin">
<tr>
	<td valign="top"><strong>E-commerce site:</strong></td>
	<td valign="top"><input type="text" name="merchant_name" value="{$rsMerchant->merchant_name}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>URL template for links:</strong></td>
	<td valign="top"><input type="text" name="merchant_url" value="{$rsMerchant->merchant_url}" size="50"></td>
</tr>
<tr>
	<td valign="top"><strong>Image URL to track impressions:</strong></td>
	<td valign="top"><input type="text" name="merchant_url_image" value="{$rsMerchant->merchant_url_image}" size="50"></td>
</tr>
</table>

<p>
<input type="submit" value="Save">
<input type="reset" value="Reset">
</p>

</form>
