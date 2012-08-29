Vigilant Media Network
======================

Welcome to the Vigilant Media Network, a set of personal web projects developed and maintained by Greg Bueno.

History
-------

My career on the web started in newspapers, where I was a content producer for Austin 360 from 1997-2000. Back then, content was edited and maintained manually. Content management systems were in their infancy, and blogs were still called "online journals."

I made the transition to web software engineering in 2000 out of an interest to automate my own web writing. I went so far as to build a custom PHP front-end to Movable Type, which eventually evolved into an ad hoc framework I would use professionally till 2008.

That year, I started to move my sites to CodeIgniter and eventually retired my own system.

About this repository
---------------------

This repository contains just about all the code that currently powers the many sites I run (with the exception of configuration files.) I have no specific reason for doing so, but perhaps laying all this messiness out will give me incentive to clean house. And what a messy house it is.

The lay of the land
-------------------

CodeIgniter Sites
~~~~~~~~~~~~~~~~~

CodeIgniter sites are run from a single installation located in the ``vigilantmedia.com/vigilante/`` folder. Each site is a sub-folder in the ``application/`` directory, although some sites are grouped together by their domain (musicwhore.org, vigilantmedia.com, etc.)

The actual document root of the site contains the ``index.php`` file which initializes CodeIgniter. The document root also contains folders for CSS, images, JavaScript and other media files.

Views are rendered by the Smarty template engine. The ``views/`` folder in an application contains subfolders for templates and the template cache. The Smarty Library is instantiated from within the ``system/libraries`` folder to make it available to all sites.

I'll admit my ``system/libraries`` folder is a lot more polluted than it should be. This is due to running a single installation instead of separate installations for each site.

Here's an example of a Vigilant Media Network CodeIgniter site:

``gregbueno.com/``
     ``www/``
        ``index.php`` -- ``$application_folder`` points to ``gregbueno`` subfolder 

``vigilantmedia.com/``
    ``vigilante/``
        ``application/``
            ``gregbueno/``

Third-party applications
~~~~~~~~~~~~~~~~~~~~~~~~

Save for MediaWiki, all third-party applications are installed as subdomains of ``vigilantmedia.com``. WordPress is installed in the ``vigilantmedia.com/wp`` folder, Drupal in ``vigilantmedia.com/drupal`` and Movable Type in ``vigilantmedia.com/mt/``.

In the case of Movable Type, it's part of a larger custom content management system which associated Movable Type content with a custom database. See the `Musicwhore.org Archive
<http://archive.musicwhore.org/>`_ for an example.

Third-party libraries
~~~~~~~~~~~~~~~~~~~~~

Vigilant Media Network sites use jQuery and Blueprint CSS, both of which are also served from the ``vigilante`` folder.

Vigilant Media Network sites
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

* eponymous4.com_
* emptyensemble.com_
* gregbueno.com_
* musicwhore.org_
* observantrecords.com_
* vigilantmedia.com_

.. _eponymous4.com: http://eponymous4.com/
.. _emptyensemble.com: http://emptyensemble.com/
.. _filmwhore.org: http://filmwhore.org/
.. _gregbueno.com: http://gregbueno.com/
.. _musicwhore.org: http://musicwhore.org/
.. _observantrecords.com: http://observantrecords.com/
.. _vigilantmedia.com: http://vigilantmedia.com/
