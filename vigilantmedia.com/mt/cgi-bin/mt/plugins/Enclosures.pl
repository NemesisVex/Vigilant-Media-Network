#
# Enclosures.pl
#
# MT-Enclosures: A Movable Type plugin tag for extracting media links from blog entries
# and creates enclosures in RSS 2.0 feeds.
#
# Author: Brandon Fuller (brandon@fuller.name)
#
# See http://brandon.fuller.name/archives/hacks/mtenclosures/ for documentation,
# installation instructions, version history, and donations.
#
# This is version 1.4.5.0 published on December 14, 2005.
#
# Copyright (c) 2004-2005 Brandon Fuller
#
# License: http://creativecommons.org/licenses/LGPL/2.1/
#
# This library is free software; you can redistribute it and/or
# modify it under the terms of the GNU Lesser General Public
# License as published by the Free Software Foundation; either
# version 2.1 of the License, or (at your option) any later version.
#
# This library is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU  
# Lesser General Public License for more details.
#

package MT::Plugin::Enclosures;
use strict;

use vars qw( $VERSION );
$VERSION = '1.4.5.0';

use MT;
use MT::Template::Context;
use MT::Util qw(decode_html encode_xml);
use HTTP::Response;
use HTTP::Request::Common;

# Define to match your preferences
my $g_templateNameRss20 = 'RSS 2.0 Index';
my $g_categoryName = 'Podcasts';

if ( MT->version_number >= 3 )
{
	require MT::Plugin;

	my $plugin = new MT::Plugin();

	$plugin->description( 'Extracts media links from blog entries and creates enclosures in RSS 2.0 feeds.' ); 
	$plugin->doc_link( 'http://brandon.fuller.name/archives/hacks/mtenclosures/' );

	if ( MT->version_number >= 3.2 )
	{
		$plugin->name( 'MT-Enclosures' );
		$plugin->version( $VERSION  );
		$plugin->author_name( 'Brandon Fuller' );
		$plugin->author_link( 'http://brandon.fuller.name/' );
	}
	else
	{
		$plugin->name( 'MT-Enclosures, v' . $VERSION );
	}

	MT->add_plugin( $plugin );

	MT::Entry->add_callback( "post_save",  8, $plugin, \&cb_EnclosuresEntrySave );
}

MT::Template::Context->add_tag( EntryEnclosures => \&hdlr_Enclosures );
MT::Template::Context->add_container_tag( BlogEnclosures => \&hdlr_BlogEnclosures );
MT::Template::Context->add_tag( EnclosureURL => \&hdlr_EnclosureUrl );
MT::Template::Context->add_tag( EnclosureLength => \&hdlr_EnclosureLength );
MT::Template::Context->add_tag( EnclosureMIME => \&hdlr_EnclosureMime );

sub doLog
{
	my ($msg) = @_;

	use MT::Log;
	my $log = MT::Log->new;
	
	if ( defined( $msg ) )
	{
		$log->message( $msg );
	}

	$log->save or die $log->errstr;
}

sub build_expr
{
	my ($ctx, $val) = @_;

	$val = decode_html( $val );
	if (($val =~ m/\<MT.*?\>/) || ($val =~ s/\[(\/?MT(.*?))\]/\<$1\>/g))
	{
		my $builder = $ctx->stash('builder');
		my $tok = $builder->compile( $ctx, $val );       
		defined( $val = $builder->build( $ctx, $tok ) ) or return $ctx->error( $builder->errstr );  
	}

	return $val;
}

sub processUrl
{
	my ($ctx, $args, $fContainer, $url) = @_;
	my $builder = $ctx->stash('builder');
	my $tokens = $ctx->stash('tokens');
	my $argRemote = defined( $args->{remote} ) ? build_expr( $ctx, $args->{remote} ) : 1;
	my $argLog = defined( $args->{log} ) ? build_expr( $ctx, $args->{log} ) : 1;
	my $argUrlInclude = '';
	my $argUrlExclude = '';
	my $argMimeInclude = '';
	my $argMimeExclude = defined( $args->{mime_exclude} ) ? build_expr( $ctx, $args->{mime_exclude} ) : '';
	my $useUrl = '';
	my $useLen = 0;
	my $res = '';
	my $mime = '';

	#
	# Setup the params.  Some are backwards compat.
	#

	if ( defined( $args->{url_include} ) )
	{
		 $argUrlInclude = build_expr( $ctx, $args->{url_include} );
	}
	elsif ( defined( $args->{include} ) )
	{
		 $argUrlInclude = build_expr( $ctx, $args->{include} );
	}

	if ( defined( $args->{url_exclude} ) )
	{
		 $argUrlExclude = build_expr( $ctx, $args->{url_exclude} );
	}
	elsif ( defined( $args->{exclude} ) )
	{
		 $argUrlExclude = build_expr( $ctx, $args->{exclude} );
	}

	if ( defined( $args->{mime_include} ) )
	{
		 $argMimeInclude = build_expr( $ctx, $args->{mime_include} );
	}
	elsif ( defined( $args->{mine} ) )
	{
		 $argMimeInclude = build_expr( $ctx, $args->{mime} );
	}

	#
	# What URL to include
	#

	if ( $argUrlInclude ne '' )
	{
		(my $argUrlIncludePattern = $argUrlInclude) =~ s/\//\\\//g;

		if ( ! ( $url =~ /$argUrlIncludePattern/i ) )
		{
			return $res;
		}
	}

	#
	# What URL to exclude
	#

	if ( $argUrlExclude ne '' )
	{
		(my $argUrlExcludePattern = $argUrlExclude) =~ s/\//\\\//g;

		if ( $url =~ /$argUrlExcludePattern/i )
		{
			return $res;
		}
	}

	#
	# Match MIME type
	#

	if ( $url =~ /^.*\.mp3$/i )
        {   
		$mime = 'audio/mpeg';
	}
	elsif ( $url =~ /^.*\.wma$/i )
	{
		$mime = 'audio/wma';
	}
	elsif ( $url =~ /^.*\.m4a$/i )
	{
		$mime = 'audio/mp4';
	}
	elsif ( $url =~ /^.*\.midi$/i )
	{
		$mime = 'audio/midi';
	}
	elsif ( $url =~ /^.*\.wav$/i )
	{
		$mime = 'audio/wav';
	}
	elsif ( $url =~ /^.*\.aa$/i )
	{
		$mime = 'audio/aa';
	}
	elsif ( $url =~ /^.*\.(mp4|m4v)$/i )
	{
		$mime = 'video/mp4';
	}
	elsif ( $url =~ /^.*\.mpeg$/i )
	{
		$mime = 'video/mpeg';
	}
	elsif ( $url =~ /^.*\.avi$/i )
	{
		$mime = 'video/msvideo';
	}
	elsif ( $url =~ /^.*\.mov$/i )
	{
		$mime = 'video/quicktime';
	}
	elsif ( $url =~ /^.*\.wmv$/i )
	{
		$mime = 'video/x-ms-wmv';
	}
	elsif ( $url =~ /^.*\.ogg$/i )
	{
		$mime = 'application/ogg';
	}
	elsif ( $url =~ /^.*\.torrent$/i )
	{
		$mime = 'application/x-bittorrent';
	}
	elsif ( $url =~ /^.*\.exe$/i )
	{
		$mime = 'application/octet-stream';
	}
	elsif ( $url =~ /^.*\.bmp$/i )
	{
		$mime = 'image/bmp';
	}
	elsif ( $url =~ /^.*\.jpe?g$/i )
	{
		$mime = 'image/jpeg';
	}
	elsif ( $url =~ /^.*\.gif$/i )
	{
		$mime = 'image/gif';
	}
	elsif ( $url =~ /^.*\.tiff?$/i )
	{
		$mime = 'image/tiff';
	}
	elsif ( $url =~ /^.*\.png$/i )
	{
		$mime = 'image/png';
	}

	#
	# Only process URL if we had a MIME match
	#

	if ( $mime ne '' )
	{
		#
		# What MIME to include
		#

		if ( $argMimeInclude ne '' )
		{
			(my $argMimeIncludePattern = $argMimeInclude) =~ s/\//\\\//g;

			if ( ! ( $mime =~ /$argMimeIncludePattern/ ) )
			{
				return $res;
			}
		}
	
		#
		# What MIME to exclude
		#

		if ( $argMimeExclude ne '' )
		{
			(my $argMimeExcludePattern = $argMimeExclude) =~ s/\//\\\//g;

			if ( $mime =~ /$argMimeExcludePattern/i )
			{
				return $res;
			}
		}

		#
		# See if it is a local URL
		#

		my $urlSitePattern = $ctx->stash('blog')->site_url;
		$urlSitePattern =~ s/(\W)/\\$1/g;

		if ( $url =~ /^$urlSitePattern(.+)$/i )
		{
			my $file = File::Spec->catfile( $ctx->stash('blog')->site_path, $1 );
		
			if ( -f $file )
			{
				$useUrl = $url;
				$useLen = -s $file;
			}
		}

		#
		# Must be a remote URL
		#

		if ( $argRemote && $useLen == 0 && $url =~ /^https?\:\/\/.*$/i )
		{
			my $ua = MT->new_ua;
			$ua->max_size( undef ) if $ua->can('max_size');
			my $response = $ua->request( HEAD $url );

			if ( $response->is_success )
			{
				if ( $response->content_length )
				{
					$useUrl = $url;
					$useLen = $response->content_length;
				}
				elsif( $argLog )
				{
					doLog( 'MT-Enclosures: Unable to get content length for ' . $url );
				}
			}
			elsif ( $response->is_error && $argLog )
			{
				doLog( 'MT-Enclosures: Failed to get ' . $url . ' due to error ' . $response->status_line );
			}
		}
	
		#
		# Try relative or absolute without http://
		#

		if ( $useLen == 0 && $url !~ /^https?\:\/\/.*$/i )
		{
			my $file =  File::Spec->catfile( $ctx->stash('blog')->site_path, $url );

			if ( -f $file )
			{
				$useUrl = $ctx->stash('blog')->site_url;
				$useUrl .= '/' unless $useUrl =~ m/\/$/;
				$url =~ s/^\///;
				$useUrl .= $url;
				$useLen = -s $file;
			}
			elsif( $argLog )
			{
				doLog( 'MT-Enclosures: Unable to find enclosure file at ' . $file );
			}
		}

		#
		# Were we able to get the info?
		#

		if ( $useLen > 0 && $useUrl ne '' )
		{
			if ( $fContainer )
			{
				$ctx->stash( 'MT-Enclosures-URL', $useUrl );
				$ctx->stash( 'MT-Enclosures-Length', $useLen );
				$ctx->stash( 'MT-Enclosures-MIME', $mime );

				defined( my $out = $builder->build( $ctx, $tokens ) ) or return $ctx->error( $builder->errstr );
				$res .= $out;
			}
			else
			{
				$res .= "<enclosure url=\"" . $useUrl . "\" length=\"" . $useLen . "\" type=\"" . $mime . "\" />";
			}
		}
	}

	$res;
}

sub processEntry
{
	my ($ctx, $args, $fContainer) = @_;
	my @allUrls;
	my $attrs = '';
	my $text = '';
	my $res = '';

	#
	# Pull out the text to scan
	#

	if ( $ctx->stash('entry')->text )
	{
		$text .= $ctx->stash('entry')->text;
	}

	if ( $ctx->stash('entry')->text_more )
	{
		$text .= $ctx->stash('entry')->text_more;
	}

	#
	# Do <a>
	#

	while ( $text =~ m#<a\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#href="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#href='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <img>
	#

	while ( $text =~ m#<img\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <embed>
	#

	while ( $text =~ m#<embed\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#href="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#href='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <video>
	#

	while ( $text =~ m#<video\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <wmv>
	#

	while ( $text =~ m#<wmv\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <qt>
	#

	while ( $text =~ m#<qt\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}


	#
	# Do <audio>
	#

	while ( $text =~ m#<audio\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Do <podcast>
	#

	while ( $text =~ m#<podcast\s+([^>]*)>#ig )
	{
		$attrs = $1;

		if ( $attrs =~ m#src="([^"]+)"#i )
		{
                        push( @allUrls, $1 );
		}
		elsif ( $attrs =~ m#src='([^']+)'#i )
		{
                        push( @allUrls, $1 );
		}
	}

	#
	# Get unique URLs
	#

	my %seen = ();
	my @uniqueUrls = grep { ! $seen{$_} ++ } @allUrls;

	#
	# Process the URLs
	#

	foreach my $url ( sort @uniqueUrls )
	{
		$res .= processUrl( $ctx, $args, $fContainer, $url );
	}

	#
	# Return the output
	#

	return $res;
}

sub hdlr_Enclosures
{
	my ($ctx, $args) = @_;
	my $res = '';

	if ( $ctx->stash('entry') )
	{
		$res .= processEntry( $ctx, $args, 0 );
	}
	else
	{
		return $ctx->error( "The <MTEntryEnclosures> tag must be used inside of a <MTEntries> block." );
	}

	#
	# Return the output
	#

	return $res;
}

sub doPing
{
	my ($url, $method, $blogname, $blogurl) = @_;
	my $ua = MT->new_ua;
	my $req = HTTP::Request->new( 'POST', $url );

	$req->header( 'Content-Type' => 'text/xml' );
	my $blog_name = encode_xml($blogname);
	my $blog_url = encode_xml($blogurl);
	my $text = <<XML;
<?xml version="1.0"?>
<methodCall>
    <methodName>$method</methodName>
    <params>
    <param><value>$blogname</value></param>
    <param><value>$blogurl</value></param>
    </params>
</methodCall>
XML
	$req->content( $text );
	my $res = $ua->request( $req );
	if ( substr( $res->code, 0, 1 ) ne '2' )
	{
		return MT->translate( "HTTP error: [_1]", $res->status_line );
	}

	my $content = $res->content;
	my ($error) = $content =~ m!flerror.*?<boolean>(\d+)!s;
	my ($msg) = $content =~ m!message.*?<value>(.+?)</value>!s;
	if ( $error )
	{
		return MT->translate( "Ping error: [_1]", $msg );
	}

	return '';
}

sub cb_EnclosuresEntrySave
{
        my ($eh, $obj) = @_;
	my $errstr = '';
	my $entry_id = $obj->id;

        require MT::Blog;
        my $blog = MT::Blog->load( $obj->blog_id );

	if ( $obj->status == 2 && defined( $obj->category ) && $obj->category->label eq $g_categoryName )
	{
		#
		# Figure out the RSS 2.0 template link
		#

		require MT::Template;
		my $tmpl = MT::Template->load({ name => $g_templateNameRss20,
                                        type => 'index',
                                        blog_id => $obj->blog_id })
            				or return $eh->error( MT->translate( "Can't find template '[_1]'", $g_templateNameRss20 ));
		my $site_url = $blog->site_url;
		$site_url .= '/' unless $site_url =~ m!/$!;

		#
		# Do the ping
		#

		$errstr = doPing( 'http://audiorpc.weblogs.com/RPC2', 'audioUpdate', $blog->name, $site_url . $tmpl->outfile );
		if ( $errstr ne '' )
		{
			return $eh->error( $errstr );
		}
		else
		{
			doLog( 'Successfully pinged audiorpc.weblogs.com' );
		}
	}
}

sub hdlr_BlogEnclosures
{
        my ($ctx, $args) = @_;
	my $res = '';

        my $iter = MT::Entry->load_iter( { blog_id => $ctx->stash('blog')->id, status => MT::Entry::RELEASE() }, { 'sort' => 'created_on', direction => 'descend' } );

        while ( my $entry = $iter->() )
	{
		$ctx->{current_timestamp} = $entry->created_on;
		$ctx->{modification_timestamp} = $entry->modified_on;
		$ctx->stash( 'entry', $entry );

		$res .= processEntry( $ctx, $args, 1 );
	}

	return $res;
}

sub hdlr_EnclosureUrl
{
	my ($ctx, $args) = @_;  
         
	return defined( $ctx->stash('MT-Enclosures-URL') ) ? $ctx->stash('MT-Enclosures-URL') : '';
}

sub hdlr_EnclosureLength
{
	my ($ctx, $args) = @_;
	my $argFormat = defined( $args->{format} ) ? build_expr( $ctx, $args->{format} ) : 'b';
	my $argLabel = defined( $args->{label} ) ? build_expr( $ctx, $args->{label} ) : 0;

	if ( $args->{format} && $ctx->stash('MT-Enclosures-Length') ne '' )
	{
		return formatBytes( $ctx->stash('MT-Enclosures-Length'), $argFormat, $argLabel );
	}
	else
	{
		return defined( $ctx->stash('MT-Enclosures-Length') ) ? $ctx->stash('MT-Enclosures-Length') : '';
	}
}

sub hdlr_EnclosureMime
{
	my ($ctx, $args) = @_;  

	return defined( $ctx->stash('MT-Enclosures-MIME') ) ? $ctx->stash('MT-Enclosures-MIME') : '';
}

sub formatBytes
{
	my ($bytes, $format, $label) = @_;
	my $kb = $bytes / 1024;
	my $mb = $kb / 1024;
	my $gb = $mb / 1024;
	my $res = '';

	if ( lc $format eq 'b' )
	{
		$res .= $bytes;

		if ( $label )
		{
			$res .= " b";
		}
	}
	elsif ( lc $format eq 'k' )
	{
		$res .= sprintf( "%0.1f", $kb );

		if ( $label )
		{
			$res .= " KB";
		}
	}
	elsif ( lc $format eq 'm' )
	{
		$res .= sprintf( "%0.1f", $mb );

		if ( $label )
		{
			$res .= " MB";
		}
	}
	elsif ( lc $format eq 'g' )
	{
		$res .= sprintf( "%0.1f", $gb );

		if ( $label )
		{
			$res .= " GB";
		}
	}

	return $res;
}

   
1;
