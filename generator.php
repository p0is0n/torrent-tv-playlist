<?php

$sourcesGid = "compress.zlib://https://iptvx.one/epg/epg.xml.gz"; // "compress.zlib://http://www.teleguide.info/download/new3/xmltv.xml.gz";
$sources = (array(
    1 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=72',
        'title' => 'ТНТ',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => 'tnt', // '101',
            'offset' => '+0000',
        )),
    )),

    2 => (array(
        'location' => 'http://192.168.1.38:6878/ace/getstream?id=ff791520363b73699987bedf08b6d8c25d7770d5', // 'http://127.0.0.1:6689/stream?cid=4414',
        'title' => 'ТНТ (HD)',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => 'tnt-hd', // '101',
            'offset' => '+0000',
        )),
    )),

    3 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3875',
        'title' => 'ТНТ (+2)',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => 'tnt-pl2', // '101',
            'offset' => '+0000',
        )),
    )),

    /*4 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4788',
        'title' => 'ТНТ (+3)',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0300',
        )),
    )),*/

    5 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3942',
        'title' => 'ТНТ (+4)',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => 'tnt-pl4', // '101',
            'offset' => '+0000',
        )),
    )),

    6 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4329',
        'title' => 'ТНТ (+7)',
        'image' => 'http://cdn.tnt-online.ru/masha_layer/img/tnt-logo.png',

        'gid' => (array(
            'id' => 'tnt-pl7', // '101',
            'offset' => '+0000',
        )),
    )),

    7 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=69',
        'title' => 'Пятница',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg/1200px-%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg.png',

        'gid' => (array(
            'id' => 'piatnica', // '1671',
            'offset' => '+0000',
        )),
    )),

    8 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3837',
        'title' => 'Пятница (+2)',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg/1200px-%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg.png',

        'gid' => (array(
            'id' => 'piatnica-pl2', // '1671',
            'offset' => '+0000',
        )),
    )),

    33 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4789',
        'title' => 'Пятница (+7)',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg/1200px-%D0%9F%D1%8F%D1%82%D0%BD%D0%B8%D1%86%D0%B0_%28%D1%81_2013%29.svg.png',

        'gid' => (array(
            'id' => 'piatnica-pl7', // '1671',
            'offset' => '+0000',
        )),
    )),

    27 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3763',
        'title' => 'ТНТ4',
        'image' => 'https://vignette.wikia.nocookie.net/tvpedia/images/5/53/%D0%A2%D0%9D%D0%A24.png/revision/latest?cb=20160327160014&path-prefix=ru',

        'gid' => (array(
            'id' => 'tnt4', // '2068',
            'offset' => '+0000',
        )),
    )),

    9 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3777',
        'title' => 'Paramount Comedy',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/1/1b/Paramount_Comedy.png',

        'gid' => (array(
            'id' => 'paramount-comedy', // '1755',
            'offset' => '+0000',
        )),
    )),

    /*10 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4379',
        'title' => 'Paramount Comedy (HD)',
        'image' => 'https://static-sesure.cdn.megafon.tv/images/Channel/e4/89/589782c02ab5afd865d96298ea2774a29cc2/logo_poster__web.png',

        'gid' => (array(
            'id' => 'paramount-comedy', // '1755',
            'offset' => '+0000',
        )),
    )),*/

    31 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3654',
        'title' => '2x2',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/fb/2x2_%D1%82%D0%B5%D0%BB%D0%B5%D0%BA%D0%B0%D0%BD%D0%B0%D0%BB._%D0%9B%D0%BE%D0%B3%D0%BE%D1%82%D0%B8%D0%BF.jpg',

        'gid' => (array(
            'id' => '2na2', // '276',
            'offset' => '+0000',
        )),
    )),

    32 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4079',
        'title' => '2x2 (+2)',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/fb/2x2_%D1%82%D0%B5%D0%BB%D0%B5%D0%BA%D0%B0%D0%BD%D0%B0%D0%BB._%D0%9B%D0%BE%D0%B3%D0%BE%D1%82%D0%B8%D0%BF.jpg',

        'gid' => (array(
            'id' => '2na2-pl2', // '276',
            'offset' => '+0000',
        )),
    )),

    11 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3789',
        'title' => 'Fox',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/FOX_wordmark-orange.svg/1832px-FOX_wordmark-orange.svg.png',

        'gid' => (array(
            'id' => 'fox', // '300010',
            'offset' => '+0000',
        )),
    )),

    12 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3823',
        'title' => 'Fox (HD)',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/FOX_HD.svg/512px-FOX_HD.svg.png',

        'gid' => (array(
            'id' => 'fox-hd', // '300127',
            'offset' => '+0000',
        )),
    )),

    13 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3845',
        'title' => 'Fox Life',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/2/27/Fox_life_it.png',

        'gid' => (array(
            'id' => 'foxlife', // '300056',
            'offset' => '+0000',
        )),
    )),

    14 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3917',
        'title' => 'Fox Life (HD)',
        'image' => 'https://vignette1.wikia.nocookie.net/logosfake/images/2/2c/FOXlife_HD_Logo.png/revision/latest?cb=20140414171410',

        'gid' => (array(
            'id' => 'foxlife-hd', // '1356',
            'offset' => '+0000',
        )),
    )),

    15 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3780',
        'title' => 'LifeNews',
        'image' => 'http://logo-load.com/uploads/posts/2016-02/1455284367_logo-lifenews.png',

        'gid' => (array(
            'id' => 'lifenews', // '100078',
            'offset' => '+0000',
        )),
    )),

    /*16 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3835',
        'title' => 'LifeNews (HD)',
        'image' => 'http://logo-load.com/uploads/posts/2016-02/1455284367_logo-lifenews.png',

        'gid' => (array(
            'id' => 'lifenews', // '100078',
            'offset' => '+0000',
        )),
    )),*/

    17 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=87',
        'title' => 'Россия 24',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/thumb/7/7c/Russia_24_2016.png/1920px-Russia_24_2016.png',

        'gid' => (array(
            'id' => 'rossia-24', // '676',
            'offset' => '+0000',
        )),
    )),

    18 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3896',
        'title' => 'Первый канал',
        'image' => 'http://liveam.tv/assets/images/chnl/pervij-kanal.png',

        'gid' => (array(
            'id' => 'pervy', // '1',
            'offset' => '+0000',
        )),
    )),

    45 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4264',
        'title' => 'Первый канал (Евразия)',
        'image' => 'http://liveam.tv/assets/images/chnl/pervij-kanal.png',

        /*'gid' => (array(
            'id' => 'ntv', // '4',
            'offset' => '+0000',
        )),*/
    )),

    19 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3944',
        'title' => 'НТВ',
        'image' => 'https://vignette2.wikia.nocookie.net/tvpedia/images/2/2d/%D0%9D%D0%A2%D0%92_1994-1997_%28%D0%BD%D0%B5%D0%B1%D1%80%D0%B5%D0%B6%D0%BD%D0%BE%D0%B5_%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D1%8F%29.png/revision/latest?cb=20121220130359&path-prefix=ru',

        'gid' => (array(
            'id' => 'ntv', // '4',
            'offset' => '+0000',
        )),
    )),

    20 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4385',
        'title' => 'My Zen TV HD',
        'image' => 'https://www.thematv.com/medias/channels/myzen-tv/myzen-tv.png',

        'gid' => (array(
            'id' => 'myzen-hd', // '300034',
            'offset' => '+0000',
        )),
    )),

    21 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3766',
        'title' => 'Наука 2.0',
        'image' => 'https://ortus-global.com/files/253/nauka20big.png',

        'gid' => (array(
            'id' => 'nauka-20', // '300105',
            'offset' => '+0000',
        )),
    )),

    26 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3934',
        'title' => 'Da Vinci Learning',
        'image' => 'https://vignette1.wikia.nocookie.net/tvpedia/images/4/49/Da_Vinci_Learning.png/revision/latest?cb=20140514085410&path-prefix=ru',

        'gid' => (array(
            'id' => 'da-vinci-learning-ru',
            'offset' => '+0000',
        )),
    )),

    35 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4070',
        'title' => 'Food Network',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Food_Network.svg/2000px-Food_Network.svg.png',

        'gid' => (array(
            'id' => 'food-network',
            'offset' => '+0000',
        )),
    )),

    36 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3806',
        'title' => 'History Channel',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/History_Logo.svg/512px-History_Logo.svg.png',

        'gid' => (array(
            'id' => 'history',
            'offset' => '+0000',
        )),
    )),

    37 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3790',
        'title' => 'Sony Sci-Fi',
        'image' => 'https://satsis.info/uploads/posts/2015-09/thumbs/1441802261_www.satsis.info__sony-sci-fi.png',

        'gid' => (array(
            'id' => 'sony-scifi',
            'offset' => '+0000',
        )),
    )),

    38 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3768',
        'title' => 'Discovery Channel',
        'image' => 'https://cf.press.discovery.com/ugc/logos/2009/08/22/DSC_pos.png',

        'gid' => (array(
            'id' => 'discovery-channel',
            'offset' => '+0000',
        )),
    )),

    39 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3650',
        'title' => 'Discovery Science',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Discovery_science.png',

        'gid' => (array(
            'id' => 'discovery-science',
            'offset' => '+0000',
        )),
    )),

    44 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3658',
        'title' => 'National Geographic',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Natgeologo.svg/1000px-Natgeologo.svg.png',

        'gid' => (array(
            'id' => 'national-geographic',
            'offset' => '+0000',
        )),
    )),

    22 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3765',
        'title' => 'Nickelodeon',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Nickelodeon_logo_new.svg/1000px-Nickelodeon_logo_new.svg.png',

        'gid' => (array(
            'id' => 'nickelodeon-ru', // '218',
            'offset' => '+0000',
        )),
    )),

    23 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3801',
        'title' => 'Nickelodeon (HD)',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Nickelodeon_logo_new.svg/1000px-Nickelodeon_logo_new.svg.png',

        'gid' => (array(
            'id' => 'nickelodeon-hd', // '1391',
            'offset' => '+0000',
        )),
    )),

    40 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3772',
        'title' => 'Disney Channel',
        'image' => 'http://vignette3.wikia.nocookie.net/disney/images/c/c5/Disney-channel-new2015.png/revision/latest?cb=20150813203959',

        'gid' => (array(
            'id' => 'disney',
            'offset' => '+0000',
        )),
    )),

    41 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4312',
        'title' => 'Disney Channel (+2)',
        'image' => 'http://vignette3.wikia.nocookie.net/disney/images/c/c5/Disney-channel-new2015.png/revision/latest?cb=20150813203959',

        'gid' => (array(
            'id' => 'disney-pl2',
            'offset' => '+0000',
        )),
    )),

    24 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3792',
        'title' => 'Europa Plus TV',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/c/c8/Europa_Plus_TV.Png',

        'gid' => (array(
            'id' => 'europa-plus-tv', // '300121',
            'offset' => '+0000',
        )),
    )),

    28 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3820',
        'title' => 'MTV Hits',
        'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/MTV_Hits_2013_logo.svg/2000px-MTV_Hits_2013_logo.svg.png',

        'gid' => (array(
            'id' => 'mtv-hits', // '1178',
            'offset' => '+0000',
        )),
    )),

    29 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3793',
        'title' => 'MTV Dance',
        'image' => 'https://upload.wikimedia.org/wikipedia/en/thumb/f/ff/MTV_Dance_2017_logo.svg/200px-MTV_Dance_2017_logo.svg.png',

        'gid' => (array(
            'id' => 'mtv-dance', // '100029',
            'offset' => '+0000',
        )),
    )),

    30 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3936',
        'title' => 'MTV Россия',
        'image' => 'https://vignette4.wikia.nocookie.net/tvpedia/images/c/c1/MTV_%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F_2_%28%D1%81_%D0%BD%D0%B0%D0%B4%D0%BF%D0%B8%D1%81%D1%8C%D1%8E%29.png/revision/latest?cb=20130126090333&path-prefix=ru',

        'gid' => (array(
            'id' => 'mtv-russia', // '107',
            'offset' => '+0000',
        )),
    )),

    25 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3568',
        'title' => 'Матч ТВ',
        'image' => 'http://toplogos.ru/images/logo-match-tv.png',

        'gid' => (array(
            'id' => 'match-tv', // '2060',
            'offset' => '+0000',
        )),
    )),

    34 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3675',
        'title' => 'Extreme Sports',
        'image' => 'https://upload.wikimedia.org/wikipedia/en/thumb/f/f0/Extreme_Sports_Channel.svg/1200px-Extreme_Sports_Channel.svg.png',

        'gid' => (array(
            'id' => 'extreme-sports',
            'offset' => '+0000',
        )),
    )),

    43 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3927',
        'title' => 'Мужской',
        'image' => 'http://vignette1.wikia.nocookie.net/tvpedia/images/2/21/%D0%9C%D1%83%D0%B6%D1%81%D0%BA%D0%BE%D0%B9_2_%28TV%29.png/revision/latest?cb=20121206062113&path-prefix=ru',

        'gid' => (array(
            'id' => 'muzhskoy',
            'offset' => '+0000',
        )),
    )),

    42 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3741',
        'title' => 'Brazzers TV Europe',
        'image' => 'http://ocdn.eu/images/program-tv/NzM7MDA_/079206355379db37d9b54993cc65fc36.png',

        'gid' => (array(
            'id' => 'brazzers-tv-europe',
            'offset' => '+0000',
        )),
    )),

));

$sourcesByGid = array();
$sourcesByName = array();

foreach($sources as $id => &$source) {
    /*// Check image
    if (! empty($source)) {
        if (! file_get_contents($source['image'])) {
            // Fail
            var_dump($source);
        }
    }*/

    if (! empty($source['gid'])) {
        if (! isset($sourcesByGid[$source['gid']['id']])) {
            $sourcesByGid[$source['gid']['id']] = array();
        }

        $sourcesByGid[$source['gid']['id']][$id] = &$source;
    }

    // Clean
    unset($source);
}

// Log function
$log = (function($message, $inline = false) {
    if (false !== $inline) {
        $message = preg_replace('/[\s]+/si', ' ' , $message);
    }

    if (! empty($message)) {
        echo(date('r') . " - " . $message . "\n");
    }
    else {
        echo("\n");
    }
});

declare(ticks=1);

$namespace = rtrim(basename($_SERVER["SCRIPT_FILENAME"]), '.php');

$rootdir = realpath(dirname(__FILE__));

$pidfile = $rootdir . '/' . $namespace . '.pid';
$statefile = $rootdir . '/' . $namespace . '.state';

foreach(array_merge(array($pidfile)) as $index => $file) {
    if (file_exists($file)) {
        if (($pid = file_get_contents($file))) {
            $pid = intval($pid);
            $pid = (! empty($pid) && $pid > 0 && posix_kill($pid, 0)) ? $pid : null;

            if (null !== $pid) {
                if (1) {
                    if ($index <= 0) {
                        // @TODO add check for PID
                        $log('Error: already running instance, pid file ' . $file . "");
                    }
                    else {
                        // @TODO add check for PID
                        $log('Error: already running other instance, pid file ' . $file . "");
                    }
                }

                // Stop
                exit(-99);
            }
        }

        if ($index <= 0) {
            // Clean
            $log('remove old pid file ' . $file);
        }
    }
}

$shutdownCallbackCalled = false;
$shutdownCallback = (function() use ($pidfile, $log) {
    global $shutdownCallbackCalled;

    // Debug
    // $log('shutdownCallback');

    if (false === $shutdownCallbackCalled) {
        if (file_exists($pidfile)) {
            unlink($pidfile);
        }

        // Mark
        $shutdownCallbackCalled = true;
    }
});

// signal handler function
$signalsHandler = (function($signo) use (&$shutdownCallback) {
    switch ($signo) {
        case SIGTERM:
            // Callbacks
            $shutdownCallback();

            // Exit
            exit;
        break;

        case SIGINT:
            // Callbacks
            $shutdownCallback();

            // Exit
            exit;
        break;
     }
});

if (($fp = @ fopen($pidfile, 'w'))) {
    fwrite($fp, posix_getpid());
    fclose($fp);
}
else
    die('Error: cannot create pid file! check for ' . $pidfile . "\n");

pcntl_signal(SIGTERM, $signalsHandler);
pcntl_signal(SIGINT,  $signalsHandler);

register_shutdown_function($shutdownCallback);

declare(ticks=1);

// Debug
$log('Start');

$playlistFile = $rootdir . '/' . $namespace . '.m3u';
$gidFile = $rootdir . '/' . $namespace . '.xml.gz';
$fileTemporarySuffix = '.tmp';

$playlistFileFp = null;
$gidFileFp = null;

$playlistFileSuccess = false;
$gidFileSuccess = false;

if (! ($playlistFileFp = fopen($playlistFile . $fileTemporarySuffix, 'wb'))) {
    // Fail
    $log('Error: cannot open playlist file ' . $playlistFile);
}

if (! ($gidFileFp = gzopen($gidFile . $fileTemporarySuffix, 'w9'))) {
    // Fail
    $log('Error: cannot open gid file ' . $gidFile);
}

if (is_resource($playlistFileFp)) {
    fwrite($playlistFileFp, '#EXTM3U');
    fwrite($playlistFileFp, "\r\n\r\n");

    foreach($sources as &$source) {
        fwrite($playlistFileFp, sprintf("#EXTINF:-1 tvg-name=\"%s\" tvg-logo=\"%s\",%s\r\n%s\r\n\r\n",
            $source['title'],
            $source['image'],
            $source['title'],
            $source['location']
        ));

        // Clean
        unset($source);
    }

    // Ok
    $playlistFileSuccess = true;

    // Close
    fclose($playlistFileFp);

    if ($playlistFileSuccess) {
        // Move
        rename($playlistFile . $fileTemporarySuffix, $playlistFile);
    }
    else {
        unlink($playlistFile . $fileTemporarySuffix);
    }
}

if (is_resource($gidFileFp)) {
    $xmlOut = new XMLWriter();

    $xmlOut -> openMemory();
    $xmlOut -> setIndent(true);

    $xmlOut -> startDocument('1.0', 'UTF-8');

    $xmlOut -> startDTD('tv', null, 'http://iptvx.one/xmltv.dtd');
    $xmlOut -> endDTD();

    $xmlOut -> startElement('tv');

    foreach($sources as $id => &$source) {
        if (! empty($source['gid'])) {
            $xmlOut -> startElement('channel');
            $xmlOut -> startAttribute('id');
            $xmlOut -> text($id);
            $xmlOut -> endAttribute();

            $xmlOut -> startElement('display-name');
            $xmlOut -> startAttribute('lang');
            $xmlOut -> text('ru');
            $xmlOut -> endAttribute();
            $xmlOut -> text($source['title']);
            $xmlOut -> endElement();

            $xmlOut -> startElement('icon');
            $xmlOut -> startAttribute('src');
            $xmlOut -> text($source['image']);
            $xmlOut -> endAttribute();
            $xmlOut -> endElement();

            $xmlOut -> endElement(); // channel
        }

        // Clean
        unset($source);
    }

    gzwrite($gidFileFp, $xmlOut -> flush());

    $context = stream_context_create(array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept: */*\r\n" .
                        "User-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.100 Safari/537.36\r\n"
    )));

    libxml_set_streams_context($context);

    $xmlIn = new XMLReader();
    $xmlIn -> open($sourcesGid);

    $dataElementCurrent = null;
    $dataElement = null;
    $data = array();

    while ($xmlIn -> read()) {
        if ($xmlIn -> nodeType == XMLReader::END_ELEMENT) {
            if (null !== $dataElement) {
                if ($dataElement == $xmlIn -> name) {
                    if ($dataElement == 'programme') {
                        if (isset($data['channel'])) {
                            if (isset($sourcesByGid[$data['channel']])) {
                                /*if (isset($data['date'])) {
                                    // Debug
                                    var_dump($data); exit;
                                }*/

                                foreach($sourcesByGid[$data['channel']] as $id => &$source) {
                                    if (empty($data['start']) || empty($data['stop'])) {
                                        // Skip
                                        continue;
                                    }

                                    $start = $data['start'];
                                    $stop = $data['stop'];

                                    if (preg_match('/([\d]+)(?:\s*([+-]{1}[\d]+))?/', $start, $match)) {
                                        $start = $match[1];

                                        if (! empty($match[2])) {
                                            if (! empty($source['gid']['offset'])) {
                                                $match[2] = intval($source['gid']['offset']) + intval($match[2]);
                                                $match[2] = $match[2] > 0 ? sprintf('+%04d', $match[2]) : sprintf('%05d', $match[2]);
                                            }

                                            $start .= ' ' . $match[2];
                                        }
                                        else {
                                            $start .= ' +0000';
                                        }
                                    }

                                    if (preg_match('/([\d]+)(?:\s*([+-]{1}[\d]+))?/', $stop, $match)) {
                                        $stop = $match[1];

                                        if (! empty($match[2])) {
                                            if (! empty($source['gid']['offset'])) {
                                                $match[2] = intval($source['gid']['offset']) + intval($match[2]);
                                                $match[2] = $match[2] > 0 ? sprintf('+%04d', $match[2]) : sprintf('%05d', $match[2]);
                                            }

                                            $stop .= ' ' . $match[2];
                                        }
                                        else {
                                            $stop .= ' +0000';
                                        }
                                    }

                                    $xmlOut -> startElement('programme');

                                    $xmlOut -> writeAttribute('start', $start);
                                    $xmlOut -> writeAttribute('stop', $stop);
                                    $xmlOut -> writeAttribute('channel', $id);

                                    foreach(array('title', 'category', 'desc', 'date') as $keyElement) {
                                        if (isset($data[$keyElement])) {
                                            $xmlOut -> startElement($keyElement);

                                            if (! empty($data[$keyElement]['attributes'])) {
                                                foreach($data[$keyElement]['attributes'] as $aKey => &$aValue) {
                                                    $xmlOut -> writeAttribute($aKey, $aValue);

                                                    // Clean
                                                    unset($aValue);
                                                }
                                            }

                                            $xmlOut -> text($data[$keyElement]['value']);
                                            $xmlOut -> endElement();
                                        }
                                    }

                                    $xmlOut -> endElement(); // programme

                                    // Clean
                                    unset($source);
                                }

                                // Flush
                                gzwrite($gidFileFp, $xmlOut -> flush());
                            }
                        }
                    }

                    // End
                    $dataElement = null;
                }
                else if ($dataElementCurrent == $xmlIn -> name) {
                    $dataElementCurrent = null;
                }
            }
        }
        else if ($xmlIn -> nodeType == XMLReader::ELEMENT) {
            if (null !== $dataElement) {
                $dataElementCurrent = $xmlIn -> name;
                $data[$dataElementCurrent] = array('attributes' => array());

                if ($xmlIn -> hasAttributes) {
                    while ($xmlIn -> moveToNextAttribute()) {
                        $data[$dataElementCurrent]['attributes'][$xmlIn -> name] = $xmlIn -> value;
                    }
                }
            }
            else if ($xmlIn -> name == 'programme') {
                $data = array();
                $dataElement = 'programme';

                if ($xmlIn -> hasAttributes) {
                    while ($xmlIn -> moveToNextAttribute()) {
                        $data[$xmlIn -> name] = $xmlIn -> value;
                    }
                }
            }
        }
        else if ($xmlIn -> nodeType == XMLReader::TEXT) {
            if (null !== $dataElement) {
                if (empty($data[$dataElementCurrent]['value'])) {
                    $data[$dataElementCurrent]['value'] = '';
                }

                $data[$dataElementCurrent]['value'] .= $xmlIn -> value;
            }
        }
    }

    $xmlOut -> endElement(); // tv
    $xmlOut -> endDocument();

    // Close
    gzwrite($gidFileFp, $xmlOut -> flush());
    gzclose($gidFileFp);

    $gidFileSuccess = true;

    if ($gidFileSuccess) {
        // Move
        rename($gidFile . $fileTemporarySuffix, $gidFile);
    }
    else {
        unlink($gidFile . $fileTemporarySuffix);
    }
}

// Debug
$log('Stops');
