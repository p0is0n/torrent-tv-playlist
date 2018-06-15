<?php

// Config
require_once realpath(dirname(__FILE__)) . '/config.php';

$acePrefix = $config['mitv'] . '/ace/manifest.m3u8?id=';

$channelsCacheTime = 1200;
$channels = (array(
    1 => (array(
        'source' => 'https://hdmi-tv.ru/humor/295-tnt.html',
    )),

    2 => (array(
        'source' => 'https://hdmi-tv.ru/humor/802-tnt-2.html',
    )),

    3 => (array(
        'source' => 'https://hdmi-tv.ru/humor/46-tnt-4.html',
    )),

    4 => (array(
        'source' => 'https://hdmi-tv.ru/humor/47-tnt-7.html',
    )),

    5 => (array(
        'source' => 'https://hdmi-tv.ru/humor/289-pyatnica.html',
    )),

    6 => (array(
        'source' => 'https://hdmi-tv.ru/humor/290-pyatnica-2.html',
    )),

    7 => (array(
        'source' => 'https://hdmi-tv.ru/humor/37-paramount-comedy.html',
    )),

    13 => (array(
        'source' => 'https://hdmi-tv.ru/humor/38-paramount-comedy-hd.html',
    )),

    8 => (array(
        'source' => 'https://hdmi-tv.ru/music/144-mtv-hits.html',
    )),

    9 => (array(
        'source' => 'https://hdmi-tv.ru/music/143-europa-plus-tv.html',
    )),

    10 => (array(
        'source' => '0c620b2e6ef41263dec0ea0ce93ae12fda8c898c' // https://hdmi-tv.ru/main/238-pervyy-kanal-hd.html',
    )),

    14 => (array(
        'source' => 'https://hdmi-tv.ru/main/2453-pervyy-kanal-evraziya.html',
    )),

    11 => (array(
        'source' => 'https://hdmi-tv.ru/children/303-nickelodeon-hd.html',
    )),

    12 => (array(
        'source' => 'https://hdmi-tv.ru/regional/2612-ktk.html',
    )),
));

$cacheIdKey = 'tv_cid_t%s';
$cacheIdKeyLock = null;

$isAceId = (function($value) {
    return !! preg_match('/^[a-zA-Z0-9]{32,0}$/', $value);
});

$setIdFromCache = (function($type, $source, $id) use ($cacheIdKey, $channelsCacheTime) {
    $key = sprintf($cacheIdKey, md5($source));
    $value = (array(
        'id' => $id,
        'time' => time(),
    ));

    $result = null;

    if (function_exists('apcu_fetch')) {
        if (false !== ($result = apcu_store($key, $value))) {
            return $result;
        }
    }
    else if (function_exists('apc_fetch')) {
        if (false !== ($result = apc_store($key, $value))) {
            return $result;
        }
    }
});

$getIdFromCache = (function($type, $source) use ($cacheIdKey, $channelsCacheTime) {
    $key = sprintf($cacheIdKey, md5($source));
    $result = null;

    if (function_exists('apcu_fetch')) {
        if (false !== ($result = apcu_fetch($key))) {
            // Ok
        }
    }
    else if (function_exists('apc_fetch')) {
        if (false !== ($result = apc_fetch($key))) {
            // Ok
        }
    }

    if (is_array($result)) {
        $result['current'] = time();
        $result['expired'] = $result['time'] + $channelsCacheTime <= $result['current'];

        // Debug
        // var_dump($result); exit;

        // Ok
        return $result;
    }
});

$getIdByChannel = (function($channel) use ($setIdFromCache, $getIdFromCache, $isAceId) {
    $channelType = parse_url($channel['source'], PHP_URL_HOST);
    $channelType = empty($channelType) ? null : $channelType;

    $channelId = null;
    $channelIdCache = null;
    $channelIdCacheExpired = true;

    if (! empty($channelType)) {
        $channelIdCache = $getIdFromCache($channelType, $channel['source']);

        if (! empty($channelIdCache)) {
            $channelId = $channelIdCache['id'];
            $channelIdCacheExpired = $channelIdCache['expired'];
        }
    }

    if (empty($channelId) || true === $channelIdCacheExpired) {
        if ($isAceId($channel['source'])) {
            $channelId = $channel['source'];
        }
        else {
            switch($channelType) {

                case 'hdmi-tv.ru':
                    $context = stream_context_create(array(
                        'http' => array(
                            'timeout' => 20,
                            'ignore_errors' => true,
                            'method' => "GET",
                            'user_agent' => "Mozilla/5.0 (X11; Linux x86_64)")
                    ));

                    $content = file_get_contents($channel['source'], false, $context);

                    if (! empty($content) && preg_match('/source[^>]*src="[^"]*\/ace\/manifest\.m3u8\?id=([^"&]+)"/s', $content, $match)) {
                        $channelId = $match[1];
                    }

                // Ok
                break;
            }
        }

        if (! empty($channelId)) {
            $setIdFromCache($channelType, $channel['source'], $channelId);
        }
    }

    // Ok
    return $channelId;
});

if (! empty($_GET['channel']) && isset($channels[$_GET['channel']])) {
    $channel = $channels[$_GET['channel']];
    $channelId = $getIdByChannel($channel);

    if (! empty($channelId)) {
        /*header("Status: 200");
        header("Content-Type: application/vnd.apple.mpegurl");

        header("Expires: " . gmdate("D, d M Y H:i:s", time() + $channelsCacheTime) . " GMT");
        header("Pragma: cache");
        header("Cache-Control: max-age=" . $channelsCacheTime . "");

        exit("#EXTM3U\r\n#EXT-X-VERSION:3\r\n" . $acePrefix . "" . $channelId . "\r\n");*/

        /*header("Expires: " . gmdate("D, d M Y H:i:s", time() + $channelsCacheTime) . " GMT");
        header("Pragma: cache");
        header("Cache-Control: max-age=" . $channelsCacheTime . "");*/

        header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Pragma: no-cache");
        header("Cache-Control: no-cache, must-revalidate");

        header("Location: " . $acePrefix . "" . $channelId . ""); exit;
    }

    // Fail
    header("Status: 503 Service Temporarily Unavailable");
    header("Retry-After: 180");

    header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Pragma: no-cache");
    header("Cache-Control: no-cache, must-revalidate");

    exit("503 Service Temporarily Unavailable");
}
