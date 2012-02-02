<form action="/index.php/ecommerce/merchants/remove/{$merchant_id}/" method="post" name="merchant">

<h4 class="admin_head">Delete account information</h4>

<p><span style="color: #F00"><strong>WARNING:</strong></span> Deleting a record will permanently remove it from the database. Deletions affect all related tables, including ecommerce links. You cannot undo deletions once they're performed.</p>

<p>Are you sure you want to delete <strong>{$rsMerchant->merchant_name}</strong> <em>permanently</em> from the database?<br>

<input type="hidden" name="merchant_name" value="{$rsMerchant->merchant_name}">
<input type="submit" id="confirm" name="confirm" value="Yes">
<input type="submit" name="confirm" value="No">
</p>


{literal}
<script type="text/javascript">
$(document).ready(function ()
{
	$('#confirm').click(function () {return confirm_delete('merchant');});
});
</script>
{/literal}
</form>
