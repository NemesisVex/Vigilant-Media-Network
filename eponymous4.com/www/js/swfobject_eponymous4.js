// SWFObject helpers

function load_video(file, image, block_id)
{
	var s1 = new SWFObject('/music/player.swf','player','480','360','9');
	s1.addParam('allowfullscreen','false');
	s1.addVariable('file', file);
	s1.addVariable('autostart','false');
	s1.addVariable('image', image);
	s1.write(block_id);
}

function load_track(file, block_id)
{
	var s1 = new SWFObject('/music/mediaplayer.swf', 'player', '400', '20', '7');
	s1.addParam('allowfullscreen', 'false');
	s1.addVariable('file', file);
	s1.addVariable('displaywidth','0');
	s1.addVariable('autostart', 'false');
	s1.write(block_id);
}

function load_album_player(project, div_name, version)
{
	if (version == null) {version = 'vocals';}
	var playlist_uri = build_playlist_request(project, version);
	var s1 = new SWFObject('/audio/mediaplayer.swf', 'playlist', '325', '40', '7');
	s1.addParam('allowfullscreen', 'false');
	s1.addVariable('file', playlist_uri);
	s1.addVariable('displaywidth','0');
	s1.addVariable('shuffle', 'false');
	s1.addVariable('thumbsinplaylist', 'false');
	s1.addVariable('autostart', 'false');
	s1.write(div_name);
}


function load_button(file, block_id)
{
	var s1 = new SWFObject('/music/mediaplayer.swf','player','20','20','9');
	s1.addParam('allowfullscreen','false');
	s1.addVariable('file', file);
	s1.addVariable('displaywidth','0');
	s1.addVariable('autostart','false');
	s1.write(block_id);
}

// jQuery SWFObject helpers

function jq_load_video(block_id, file_name, image_file)
{
	block_id.flash(
	{
		swf: '/music/player.swf',
		height: 360,
		width: 480,
		params:
		{
			allowfullscreen: false,
			flashvars:
			{
				file: file_name,
				image: image_file
			}
		}
	});
}

function jq_load_track(block_id, file_name, version)
{
	if (version == null) {version = 'vocals';}
	var track_uri = build_audio_url(file_name, version);
	block_id.flash(
	{
		swf: '/music/mediaplayer.swf',
		height: 20,
		width: 400,
		params:
		{
			allowfullscreen: false,
			flashvars:
			{
				file: track_uri,
				displaywidth: 0,
				autostart: false
			}
		}
	});
}

function jq_load_album_player(block_id, project, version)
{
	if (version == null) {version = 'vocals';}
	var playlist_uri = build_playlist_request(project, version);
	block_id.flash(
	{
		swf: '/audio/mediaplayer.swf',
		height: 40,
		width: 325,
		params:
		{
			allowfullscreen: false,
			flashvars:
			{
				file: playlist_uri,
				displaywidth: 0,
				shuffle: false,
				thumbsinplaylist: false,
				autostart: false
			}
		}
	});
}
function jq_load_button(block_id, file, version)
{
	if (version == null) {version = 'vocals';}
	var file_uri = build_audio_url(file, version);
	block_id.flash(
	{
		swf: '/music/mediaplayer.swf',
		height: 20,
		width: 20,
		flashvars:
		{
			file: file_uri
		}
	});
}

// Private functions

function build_audio_url(file, type)
{
	var url = 'http://eponymous4.gregbueno.com/audio/_mp3/_' + type + '/' + file;
	return url;
}

function build_playlist_request(project, version)
{
	var str;
	str = 'http://eponymous4.gregbueno.com/audio/_playlists/' + project + '_' + version + '.xml';
	return str;
}

