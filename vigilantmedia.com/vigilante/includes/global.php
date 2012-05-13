<?php

$config_url_base = array();
switch (ENVIRONMENT) {
    case 'dev':
        $config_url_base['to_vigilantmedia'] = 'http://dev.vigilantmedia.com';
        $config_url_base['to_vigilante'] = 'http://dev.vigilante.vigilantmedia.com';
        $config_url_base['to_mt'] = 'http://dev.mt.vigilantmedia.com';
        $config_url_base['to_wp'] = 'http://wp.vigilantmedia.com';
        $config_url_base['to_gregbueno'] = 'http://dev.gregbueno.com';
        $config_url_base['to_eponymous4'] = 'http://dev.eponymous4.com';
        $config_url_base['to_archive'] = 'http://dev.archive.musicwhore.org';
        $config_url_base['to_musicwhore'] = 'http://dev.musicwhore.org';
        $config_url_base['to_filmwhore'] = 'http://dev.film.musicwhore.org';
        $config_url_base['to_tvwhore'] = 'http://dev.tv.musicwhore.org';
        $config_url_base['to_journalcon'] = 'http://dev.journalcon.austin-stories.com';
        $config_url_base['to_austinstories'] = 'http://dev.austin-stories.com';
        $config_url_base['to_ddn'] = 'http://dev.duran-duran.net';
        $config_url_base['to_observant'] = 'http://dev.observantrecords.com';
        $config_url_base['to_observantshop'] = 'http://dev.shop.observantrecords.com';
        break;
    case 'test':
        $config_url_base['to_vigilantmedia'] = 'http://test.vigilantmedia.com';
        $config_url_base['to_vigilante'] = 'http://test.vigilante.vigilantmedia.com';
        $config_url_base['to_mt'] = 'http://test.mt.vigilantmedia.com';
        $config_url_base['to_wp'] = 'http://wp-test.vigilantmedia.com';
        $config_url_base['to_gregbueno'] = 'http://test.gregbueno.com';
        $config_url_base['to_eponymous4'] = 'http://test.eponymous4.com';
        $config_url_base['to_archive'] = 'http://test.archive.musicwhore.org';
        $config_url_base['to_musicwhore'] = 'http://test.musicwhore.org';
        $config_url_base['to_filmwhore'] = 'http://test.film.musicwhore.org';
        $config_url_base['to_tvwhore'] = 'http://test.tv.musicwhore.org';
        $config_url_base['to_journalcon'] = 'http://test.journalcon.austin-stories.com';
        $config_url_base['to_austinstories'] = 'http://test.austin-stories.com';
        $config_url_base['to_ddn'] = 'http://test.duran-duran.net';
        $config_url_base['to_observant'] = 'http://test.observantrecords.com';
        $config_url_base['to_observantshop'] = 'http://test.shop.observantrecords.com';
        break;
    case 'prod':
        $config_url_base['to_vigilantmedia'] = 'http://www.vigilantmedia.com';
        $config_url_base['to_vigilante'] = 'http://vigilante.vigilantmedia.com';
        $config_url_base['to_mt'] = 'http://mt.vigilantmedia.com';
        $config_url_base['to_wp'] = 'http://blog.vigilantmedia.com';
        $config_url_base['to_gregbueno'] = 'http://www.gregbueno.com';
        $config_url_base['to_eponymous4'] = 'http://www.eponymous4.com';
        $config_url_base['to_archive'] = 'http://archive.musicwhore.org';
        $config_url_base['to_musicwhore'] = 'http://www.musicwhore.org';
        $config_url_base['to_filmwhore'] = 'http://www.filmwhore.org';
        $config_url_base['to_tvwhore'] = 'http://www.tvwhore.org';
        $config_url_base['to_journalcon'] = 'http://journalcon.austin-stories.com';
        $config_url_base['to_austinstories'] = 'http://www.austin-stories.com';
        $config_url_base['to_ddn'] = 'http://www.duran-duran.net';
        $config_url_base['to_observant'] = 'http://www.observantrecords.com';
        $config_url_base['to_observantshop'] = 'http://shop.observantrecords.com';
        break;
}
?>
