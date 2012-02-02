/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*global $: true, $swf: true, $e4: true, $ep4: true, $mw: true */

(function ()
{
	var window = this;
	var Jqswf = function (selector)
	{
		return (this instanceof Jqswf) ? this.init_jqswf(selector) : new Jqswf (selector);
	};
	Jqswf.prototype =
	{
		block_id: '',
		init_jqswf: function (selector)
		{
			this.block_id = selector;
		},
		set_jqswf_property: function (property, value)
		{
			Jqswf[property] = value;
		},
		load: function (url, width, height, params, flashvars)
		{
			if (typeof flashvars != 'undefined')
			{
				params.flashvars = flashvars;
			}

			$(this.block_id).flash({
				swf: url,
				height: height,
				width: width,
				params: params
			});
		}
	};
	window.Jqswf = window.$swf = Jqswf;
}) ();


(function ()
{
	var window = this;
	var Ep4 = function (selector)
	{
		this.uri_base = 'http://eponymous4.gregbueno.com';
		this.playlist_path = '/audio/_playlists';
		this.mp3_path = '/audio/_mp3';
		this.player_path = '/audio/mediaplayer.swf';
		return (this instanceof Ep4) ? this.init_ep4(selector) : new Ep4(selector);
	};
	Ep4.prototype =
	{
		init_ep4: function (selector)
		{
			this.block_id = selector;
		},
		set_ep4_property: function (property, value)
		{
			Ep4[property] = value;
		},
		build_playlist_uri: function (project, version)
		{
			var playlist_xml = this.uri_base + this.playlist_path + '/' + project + '_' + version + '.xml';
			return playlist_xml;
		},
		build_audio_uri: function (file, type)
		{
			var audio_file =  this.uri_base + this.mp3_path + '/_' + type + '/' + file;
			return audio_file;
		},
		load_album: function (project, version, width, height)
		{
			if (typeof version == 'undefined') {version = 'vocals';}
			if (typeof width == 'undefined') {width = 400;}
			if (typeof height == 'undefined') {height = 40;}

			var playlist_uri = this.build_playlist_uri(project, version);
			var params = {allowfullscreen: false};
			var flashvars = {file: playlist_uri, displaywidth: 0, shuffle: false, thumbsinplaylist: false, autostart: false};
			this.load(this.uri_base + this.player_path, width, height, params, flashvars);
		},
		load_track: function (file_name, version, width, height)
		{
			if (typeof version == 'undefined') {version = 'vocals';}
			if (typeof width == 'undefined') {width = 400;}
			if (typeof height == 'undefined') {height = 20;}
			var track_uri = this.build_audio_uri(file_name, version);
			var params = {allowfullscreen: false};
			var flashvars = {file: track_uri, displaywidth: 0, autostart: false};
			this.load(this.uri_base + this.player_path, width, height, params, flashvars);
		},
		load_button: function (file, version, width, height)
		{
			if (typeof version == 'undefined') {version = 'vocals';}
			if (typeof width == 'undefined') {width = 20;}
			if (typeof height == 'undefined') {height = 20;}
			var track_uri = this.build_audio_uri(file, version);
			var params = {allowfullscreen: false};
			var flashvars = {file: track_uri};
			this.load(this.uri_base + this.player_path, width, height, params, flashvars);
		}
	};
	window.Ep4 = window.$e4 = Ep4;
})();

(function ()
{
	var window = this;
	var Eponymous4 = function (selector)
	{
		this.uri_base = 'http://www.eponymous4.com';
		this.player_path = '/music/player.swf';
		this.video_path = '/music/_mp4';
		this.image_path = '/images';
		this.block_id = '';
		return (this instanceof Eponymous4) ? this.init_eponymous4(selector) : new Eponymous4(selector);
	};
	Eponymous4.prototype =
	{
		init_eponymous4: function (selector)
		{
			this.block_id = selector;
		},
		set_eponymous4_property: function (property, value)
		{
			Eponymous4[property] = value;
		},
		load_video: function (video_file, image_file, width, height)
		{
			if (typeof width == 'undefined') {width = 480;}
			if (typeof height == 'undefined') {height = 360;}
			var video_uri = this._build_video_uri(video_file);
			var image_uri = this._build_image_uri(image_file);
			var params = {allowfullscreen: false};
			var flashvars = {file: video_uri, image: image_uri};
			this.load(this.uri_base + this.player_path, width, height, params, flashvars);
		},
		bandcamp_widget: function(album, size, bgcol, linkcol, height, width, bgcolor)
		{
			var url = 'http://bandcamp.com/EmbeddedPlayer.swf/album=' + album + '/size=' + size + '/bgcol=' + bgcol + '/linkcol=' + linkcol + '/';
			var params = {quality: 'high', allowscriptaccess: 'never', bgcolor: bgcolor};
			this.load(url, width, height, params);
		},
		_build_video_uri: function (file)
		{
			var video_file = this.uri_base + this.video_path + '/' + file;
			return video_file;
		},
		_build_image_uri: function (file)
		{
			var image_file = this.uri_base + this.image_path + '/' + file;
			return image_file;
		}
	};
	window.Eponymous4 = window.$ep4 = Eponymous4;
})();

(function ()
{
	var window = this;
	var Musicwhore = function (selector)
	{
		this.uri_base = 'http://www.musicwhore.org';
		this.player_path = '/mediaplayer.swf';
		this.mp3_path = '/_mp3';
		return (this instanceof Musicwhore) ? this.init_musicwhore(selector) : new Musicwhore (selector);
	};
	Musicwhore.prototype =
	{
		init_musicwhore: function (selector)
		{
			this.block_id = selector;
		},
		set_musicwhore_property: function (property, value)
		{
			Musicwhore[property] = value;
		},
		blip_widget: function ()
		{
			var params = {quality: 'high', allowscriptaccess: 'always'};
			var flashvars = {username: 'NemesisVex', limit: 25};
			this.load('http://blip.fm/_/swf/BlipEmbedPlayer.swf', '100%', 225, params, flashvars);
		},
		load_player: function (file, author, title)
		{
			var params = {allowfullscreen: false};
			var flashvars = {file: file, displaywidth: 0, shuffle: false, thumbsinplaylist: false, autostart: false, author: author, title: title};
			this.load(this.uri_base + this.player_path, 400, 40, params, flashvars);
		},
		load_podcast: function (file, title)
		{
			this.load_player(file, 'Musicwhore.org Podcast', title);
		}
	};
	window.Musicwhore = window.$mw = Musicwhore;
})();

$.extend($e4.prototype, $swf.prototype);
$.extend($ep4.prototype, $e4.prototype);
$.extend($mw.prototype, $ep4.prototype);
