Movable Type "Force Preview" Plugin
===================================

version 1.0 (1-Mar-2006)

Initial release.

Overview
--------

The Force Preview plugin helps reduce comment spam on a Movable Type blog. When enabled, commenters are required to preview their comment before posting.

The home page for this plugin is http://www.unicom.com/sw/force-preview. The latest version of this plugin is available for free at that location.

Here is what's good about this plug-in:

* It is extremely effective against comment spamming 'bots—the most common method used by comment spammers.
* Unlike most anti-spam methods (such as registration or captcha), forced comment preview doesn't burden your commenters. Your commenters probably won't even notice: they'll just click the "preview" button automatically.
* And who knows, maybe the quality of the comment on your blog will improve now that people will have to preview before posting.

Here is what's bad about this plug-in:

* Installation requires a small change to your Movable Type installation. It's in the form of a patch, which most Unix/Linux administrators know how to handle.
* Once installed, you need to enable it individually for each blog that should be protected. It will require a tweak to your comment preview template. This isn't too bad if your site runs just one blog. This will be a pain in the ass if you run dozens.
* Finally, while this plugin is extremely effective against comment spam, it does nothing to reduce trackback spam.

Part One: Install Plugin on the System
--------------------------------------

In this part, you will load the Force Preview plugin into the Movable Type installation. When complete, you will be able to activate the plugin for whichever blogs you want.

These instructions assume you have installed Movable Type on a Unix/Linux type server and have access to a shell.

First, unbundle the package tarball into the base of your Movable Type installation. For example:

    ``# cd /path/to/MT-3.2-en_US``

    ``# tar -xvz -f force-preview-1.xx.tar.gz``

This will create the following files:

* ``plugins/force-preview/README.html`` - This document.
* ``plugins/force-preview/force-preview.pl`` - The plugin.
* ``plugins/force-preview/force-preview.patch`` - Patch to MT installation (see below).
* ``plugins/force-preview/optional-templates.patch`` - Optional patch to default templates (see below).

Next, apply the included patch, using the Unix patch(1) utility:

    ``# patch -N -p0 < plugins/force-preview/force-preview.patch``

The patch will make a small change to the Movable Type comment posting module (``lib/MT/App/Comments.pm``) to perform Force Preview checking on blogs that have enabled it.

You should now be able to log into the management interface of the blog and see that the Force Preview plugin is installed. But don't activate it yet, though. That part comes next.

Part Two: Configure Blog to use Plugin
--------------------------------------

In the previous part, you loaded the plugin into the Movable Type installation. Now you need to enable the Force Preview capability. This part must be repeated for each blog you want to be protected by the Force Preview plugin.

Step One: Add Preview Token
~~~~~~~~~~~~~~~~~~~~~~~~~~~

You must modify your Comments Preview template to add a new tag. This tag will signal to the plugin that the comment has been previewed.

* Go into the management interface of your blog.
* Select: Templates » System » Comment Preview Template
* Find the line in the template that says:
    ``<form method="post" action="<$MTCGIPath$><$MTCommentScript$>">``
* Add just below it a line that says:
    ``<$MTCommentPreviewToken$>``
* Save the modified template.

Step Two: Enable Force Preview
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You are now ready to turn on the new forced comment capability for your blog.

* Go into the management interface of your blog.
* Select: Settings » Plugins
* Find the Force Preview section and click on: Show Settings.
* Enable the checkbox and save.

Step Three: Test that "Force Preview" is Working
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The Force Preview capability should now be working on your blog.

First, try to post a comment to your blog (without previewing it first). You should get an error message that tells you to preview your message before posting.

If you do not get that error message, the likely reasons are:

* You have not enabled the plugin for your blog. Re-check step two (Enable Force Preview).
* The force-preview.patch patch is not correctly applied. Re-check part one (Install Plugin on the System).

Now, this time preview your comment, and then select POST from the comment preview form. The comment should be posted.

If you continue to get the "preview your message" error, the most likely reason is that the <$MTCommentPreviewToken$> tag was not added correctly to your preview template. Re-check step one (Add Preview Token).

Step Four: Remove the Comment "POST" Button
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Finally, you should remove the POST button from the comment entry form, leaving only the PREVIEW button.

* Go into the management interface of your blog.
* Select: Templates » Archives » Individual Entry Archive
* Find the line in the template that says:
    ``<input type="submit" name="post" value=" POST " />``
* Comment it out, so that it looks like:
    ``<!-- <input type="submit" name="post" value=" POST " /> -->``
* Save the modified template.

If you use the deprecated "Comment Listing Template" popup, you should remove the post button there, too.

Optional Installation
---------------------

You can apply an additional, optional patch to the default templates. It changes the templates so that any future blogs you create automatically will support the Force Preview plugin. For these blogs you will just need to enable the plugin through the control panel; no template changes required.

I recommend you do not apply this patch until you are satisfied that you want to keep the plugin installed on your system. That's because there is no easy way to back out the changes if you do. The changes won't necessarily break any blogs, but they will leave some cruft and crud behind in the HTML.

To apply the patch, run:

    ``# patch -N -p0 < plugins/force-preview/optional-templates.patch``

Tag Documentation
-----------------

The Force Preview plugin adds three new template tags to your Movable Type installation.

``<MTCommentPreviewToken>``
~~~~~~~~~~~~~~~~~~~~~~~~~~~

This tag places a hidden token inside a comment submittions that tells the Force Preview plugin that the comment should be posted. This tag should be added to the comment preview template form.

``<MTIfForcePreviewEnabled>``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This tag is a conditional container tag. The text in the container is passed through only if Force Preview has been enabled for this blog.

``<MTIfForcePreviewDisabled>``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This tag is a conditional container tag. The text in the container is passed through only if Force Preview has been disabled for this blog.

This tag is a good way to hide the POST button when Force Preview has been enabled. For instance, you could modify your individual entry archive template to say:

    ``<MTIfForcePreviewDisabled>``

    ``<input type="submit" accesskey="s" name="post" id="comment-post" value="Post" />``

    ``</MTIfForcePreviewDisabled>``

In this example, the POST button would be hidden when Force Preview is enabled and displayed when the plugin is disabled.

Copyright © 2006, Chip Rosenthal . All rights reserved.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
