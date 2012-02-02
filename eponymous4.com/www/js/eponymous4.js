function log_audio_click(audio_id, redirect)
{
	$.ajax({
		type: 'POST',
		url: '/index.php/music/log_audio/' + audio_id + '/',
		success: function (msg)
		{
			location.href = redirect;
		}
	});
}

function log_release_click(audio_zip_file_name, redirect)
{
	$.ajax({
		type: 'POST',
		url: '/index.php/music/log_release/' + encodeURI(audio_zip_file_name) + '/',
		success: function (msg)
		{
			location.href = redirect;
		}
	});
}
