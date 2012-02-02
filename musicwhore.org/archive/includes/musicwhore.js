function get_artist_image(file_system)
{
	$.ajax({
		type: 'GET',
		url: '/index.php/images/artist/' + file_system + '/',
		success: function (msg)
		{
			if (msg != '')
			{
				var query_string = $.query.load('?' + msg);
				
				artist_path = query_string.get('artist_img');
				artist_width = query_string.get('width');
				artist_height = query_string.get('height');
				
				set_image_properties('#artist_img', '#artist_mask', artist_path, artist_width, artist_height);
			}
		}
	});
}

function get_album_image(file_system, album_image)
{
	$.ajax({
		type: 'GET',
		url: '/index.php/images/album/' + file_system + '/' + album_image + '/',
		success: function (msg)
		{
			if (msg != '')
			{
				var query_string = $.query.load('?' + msg);
				
				album_path = query_string.get('album_img');
				album_width = query_string.get('width');
				album_height = query_string.get('height');
				
				set_image_properties('#album_img', '#album_mask', album_path, album_width, album_height);
			}
		}
	});
}


function set_image_properties(image, mask, path, width, height)
{
	$(image).attr('src', path);
	$(image).attr('width', width);
	$(image).attr('height', height);
	
	$(mask).attr('width', width);
	$(mask).attr('height', height);
	$(mask).css('position', 'relative');
	$(mask).css('display', 'block');
	$(mask).css('top', (height * -1) - 2);
	$(mask).css('marginBottom', height * -1);
}
