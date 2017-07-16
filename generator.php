<?php

$sourcesGid = "compress.zlib://http://www.teleguide.info/download/new3/xmltv.xml.gz";
$sources = (array(
    1 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=72',
        'title' => 'ТНТ',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0000',
        )),
    )),

    2 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4414',
        'title' => 'ТНТ (HD)',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0000',
        )),
    )),

    3 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3875',
        'title' => 'ТНТ (+2)',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0200',
        )),
    )),

    4 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4788',
        'title' => 'ТНТ (+3)',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0300',
        )),
    )),

    5 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=3942',
        'title' => 'ТНТ (+4)',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0400',
        )),
    )),

    6 => (array(
        'location' => 'http://127.0.0.1:6689/stream?cid=4329',
        'title' => 'ТНТ (+7)',
        'image' => 'https://upload.wikimedia.org/wikipedia/ru/7/76/%D0%A2%D0%9D%D0%A2_logo.png',

        'gid' => (array(
            'id' => '101',
            'offset' => '+0700',
        )),
    )),
));

$sourcesByGid = array();
$sourcesByName = array();

foreach($sources as $id => &$source) {
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

    $xmlOut -> startDTD('tv', null, 'http://www.teleguide.info/download/xmltv.dtd');
    $xmlOut -> endDTD();

    $xmlOut -> startElement('tv');
    $xmlOut -> startAttribute('generator-info-name');
    $xmlOut -> text('TVH_W/0.751l/proxyflip');
    $xmlOut -> endAttribute();
    $xmlOut -> startAttribute('generator-info-url');
    $xmlOut -> text('http://www.teleguide.info/');
    $xmlOut -> endAttribute();

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

                                    foreach(array('title', 'category') as $keyElement) {
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
