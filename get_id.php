<?php

// Config
require_once realpath(dirname(__FILE__)) . '/config.php';

$acePrefix = $config['mitv'] . '/ace/manifest.m3u8?id=';

$channelsCacheTime = 3600;
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
));

$cacheIdKey = 'tv_cid%s';
$cacheIdKeyLock = null;

$setIdFromCache = (function($type, $source, $id) use ($cacheIdKey, $channelsCacheTime) {
    $key = sprintf($cacheIdKey, md5($source));
    $result = null;

    if (function_exists('apcu_fetch')) {
        if (false !== ($result = apcu_store($key, $id, $channelsCacheTime))) {
            return $result;
        }
    }
    else if (function_exists('apc_fetch')) {
        if (false !== ($result = apc_store($key, $id, $channelsCacheTime))) {
            return $result;
        }
    }
});

$getIdFromCache = (function($type, $source) use ($cacheIdKey) {
    $key = sprintf($cacheIdKey, md5($source));
    $result = null;

    if (function_exists('apcu_fetch')) {
        if (false !== ($result = apcu_fetch($key))) {
            return $result;
        }
    }
    else if (function_exists('apc_fetch')) {
        if (false !== ($result = apc_fetch($key))) {
            return $result;
        }
    }
});

$getIdByChannel = (function($channel) use ($setIdFromCache, $getIdFromCache) {
    $channelType = parse_url($channel['source'], PHP_URL_HOST);
    $channelType = empty($channelType) ? null : $channelType;

    $channelId = null;

    if (! empty($channelType)) {
        $channelId = $getIdFromCache($channelType, $channel['source']);
    }

    if (empty($channelId)) {
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
