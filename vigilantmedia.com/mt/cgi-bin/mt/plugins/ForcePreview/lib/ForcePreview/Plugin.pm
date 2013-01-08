# Force Preview Plugin for Movable Type
# Author: Chip Rosenthal, Greg Bueno
# Copyright (C) 2006 Chip Rosenthal, 2010 Greg Bueno
# This file is licensed under the Artistic License, or the same
# terms as Perl itself.
package ForcePreview::Plugin;

use strict;
use MT 4;

sub _get_config_force_preview
{
	my($blog_id) = @_;
	my $plugin = MT->component("ForcePreview");
	return $plugin->get_config_hash('blog:'.$blog_id)->{'force_preview'};
}

sub enabled_check
{
	my($ctx, $args) = @_;
	my $entry = $ctx->stash('entry');
	return _get_config_force_preview($entry->blog_id);
}

sub disabled_check
{
	my($ctx, $args) = @_;
	my $entry = $ctx->stash('entry');
	return !_get_config_force_preview($entry->blog_id);
}

sub _mktoken
{
	my($entry_id, $ip, $timestamp) = @_;
	Digest::MD5::md5_base64(join(";", $entry_id, $ip, $timestamp));
}

sub generate_token
{
	my($ctx, $args) = @_;
	my $entry = $ctx->stash('entry');
	my $comment = $ctx->stash('comment');
	my $currtime = time;
	my $token = _mktoken($entry->id, $comment->ip, $currtime);
	return "<input type=\"hidden\" name=\"preview_token\" value=\"$currtime;$token\">";
}

sub verify
{
	my ($cb, $app, $comment) = @_;
	my $msg;
	#
	# Return without checking unless "force_preview" is set.
	#
	return unless _get_config_force_preview($comment->blog_id);
	
	#
	# Check for token that should have been created by comment preview.
	#
	my $preview_token = $app->{query}->param('preview_token');
	$msg = "Press BACK and PREVIEW your message before posting.";
	_fail($cb, $app, $comment, $msg) unless defined($preview_token);
	
	#
	# Verify the token looks good.
	#
	my($token_time, $token_hashed) = split(/;/, $preview_token);
	$msg = "Preview token check failed.";
	_fail($cb, $app, $comment, $msg) unless $token_hashed eq _mktoken($comment->entry_id, $comment->ip, ($token_time));
	
	$msg = "Preview token has expired. Please press BACK and PREVIEW again before posting.";
	_fail($cb, $app, $comment, $msg) unless $token_time > time - 30*60; # 30 mins
	
	#
	# OK! Comment has been previewed.
	#
	return 1;
}

sub _fail
{
	my($cb, $app, $comment, $err) = @_;
	my $logmssg = "ForcePreview Plugin blocked:"
	    . " author=" . ($comment->author || "<empty>") . ";"
	    . " email=" . ($comment->email || "<empty>") . ";"
	    . " message=" . $err;
	$app->log($logmssg);
	$app->handle_error($app->translate($err));
	
	print "Content-type: text/html\n\n";
	print $err;
	exit;
}

1; # Every module must return true
