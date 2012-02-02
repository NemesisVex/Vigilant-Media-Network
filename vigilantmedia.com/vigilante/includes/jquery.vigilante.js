function parse_itunes_url(itunes_url)
{
	var url = $.query.load(itunes_url.val());
	var album_id = url.get('id');
	if (album_id != '')
		itunes_url.val(album_id);
}

function build_smarty_select_date(prefix, input_date)
{
	var year_name = prefix + 'Year';
	var month_name = prefix + 'Month';
	var day_name = prefix + 'Day';
	
	var year = $('select[name=' + year_name + ']').val();
	var month = $('select[name=' + month_name + ']').val();
	var day = $('select[name=' + day_name + ']').val();
	
	if (year!='' && month!='' && day!='')
	{
		var date = year + '-' + month + '-' + day + ' 00:00:00';
		input_date.val(date);
	}
}

function confirm_delete(label)
{
	if (label == '')
		label = 'record';
		
	if (confirm("Do you really want to delete this " + label + "?"))
		return true;
	
	return false;
}