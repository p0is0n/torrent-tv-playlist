<?php

// Config
require_once realpath(dirname(__FILE__)) . '/config.php';

$acePrefix = $config['mitv'] . '/ace/getstream?id=';
// $acePrefix = $config['mitv'] . '/ace/manifest.m3u8?id=';

$acePrefixAcelive = $config['mitv'] . '/ace/manifest.m3u8?url=';

// /iframe.html?file=http://127.0.0.1:6878/ace/manifest.m3u8?url=http://91.92.66.82/trash/ttv-list/acelive/ttv_1276_reg.acelive

$channelsCacheTime = 1200;
$channels = (array(
    1 => 'https://acestreamid.com/channel/tnt-hd', // 'https://hdmi-tv.ru/humor/295-tnt.html',
    2 => 'https://acestreamid.com/channel/tnt-(+2)', // 'https://hdmi-tv.ru/humor/802-tnt-2.html',
    3 => 'https://acestreamid.com/channel/tnt-(+4)', // 'https://hdmi-tv.ru/humor/46-tnt-4.html',
    4 => 'https://acestreamid.com/channel/tnt-(+7)', // 'https://hdmi-tv.ru/humor/47-tnt-7.html',

    5 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_2d8dbc.acelive', // 'https://hdmi-tv.ru/humor/289-pyatnica.html',
    6 => 'https://hdmi-tv.ru/humor/290-pyatnica-2.html',
    15 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_1c1972.acelive',

    7 => 'https://hdmi-tv.ru/humor/37-paramount-comedy.html',
    13 => 'https://hdmi-tv.ru/humor/38-paramount-comedy-hd.html',
    10 => 'https://acestreamid.com/channel/pervy-kanal-hd',
    14 => 'https://hdmi-tv.ru/main/2453-pervyy-kanal-evraziya.html',
    12 => 'https://hdmi-tv.ru/regional/2612-ktk.html',

    16 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_cee5e4.acelive',
    17 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_eae7cc.acelive',

    18 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_810590.acelive', // 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_254b54.acelive',

    // Kids
    80 => 'http://91.92.66.82/trash/ttv-list/acelive/ttv_cid_a73977.acelive',

    // Sport
    90 => 'http://91.92.66.82/trash/ttv-list/acelive/as_cid_cd3ba8.acelive',
    91 => 'http://91.92.66.82/trash/ttv-list/acelive/as_cid_29d636.acelive',

    // Music
    50 => 'http://91.92.66.82/trash/ttv-list/acelive/as_cid_b94a84.acelive',
    51 => 'https://hdmi-tv.ru/music/144-mtv-hits.html',
    52 => 'https://hdmi-tv.ru/music/143-europa-plus-tv.html',
    53 => 'http://91.92.66.82/trash/ttv-list/acelive/as_cid_ee5881.acelive',
));

$cacheIdKey = 'tv_cid_t%s';
$cacheIdKeyLock = null;

$isAceId = (function($value) {
    return !! preg_match('/^[a-zA-Z0-9]{32,50}$/', $value);
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
    if (preg_match('/\.acelive$/i', $channel['source'])) {
        $channelType = 'acelive';
    }
    else {
        $channelType = parse_url($channel['source'], PHP_URL_HOST);
        $channelType = empty($channelType) ? null : $channelType;
    }

    $channelId = null;
    $channelIdCache = null;
    $channelIdCacheExpired = true;

    if (! empty($channelType)) {
        if ($channelType != 'acelive') {
            $channelIdCache = $getIdFromCache($channelType, $channel['source']);

            if (! empty($channelIdCache)) {
                $channelId = $channelIdCache['id'];
                $channelIdCacheExpired = $channelIdCache['expired'];
            }
        }
    }

    if (empty($channelId) || true === $channelIdCacheExpired) {
        if ($isAceId($channel['source'])) {
            $channelId = $channel['source'];
        }
        else {
            switch($channelType) {

                case 'acelive':
                    $channelId = $channel['source'];

                // Ok
                break;

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

                case 'acestreamid.com':
                    $context = stream_context_create(array(
                        'http' => array(
                            'timeout' => 20,
                            'ignore_errors' => true,
                            'method' => "GET",
                            'user_agent' => "Mozilla/5.0 (X11; Linux x86_64)")
                    ));

                    $content = file_get_contents($channel['source'], false, $context);

                    if (! empty($content) && preg_match_all('/div[^>]*col_id[^>]*>\s*<div[^>]*>\s*<a[^>]*href="acestream:\/\/(?P<id>[a-zA-Z0-9]*)"[^>]*>.+?<div[^>]*cid_menu"[^>]*>.+?<span[^>]*votes_count[^>]*>(?P<reports>[\d]+)</s', $content, $matches, PREG_SET_ORDER)) {

                        $matches = array_slice($matches, 0, 4);
                        $matches = array_values($matches);

                        foreach($matches as $matchesIndex => &$match) {
                            $match['index'] = $matchesIndex;

                            // Clean
                            unset($match);
                        }

                        usort($matches, function($a, $b) {
                            if ($a['reports'] == $b['reports']) {
                                return $a['index'] >= $b['index'] ? 1 : -1;
                            }

                            return $a['reports'] >= $b['reports'] ? 1 : -1;
                        });

                        if (! empty($matches)) {
                            $channelId = array_shift($matches);
                            $channelId = $channelId['id'];
                        }
                    }

                // Ok
                break;
            }
        }

        if ($channelType != 'acelive') {
            if (! empty($channelId)) {
                $setIdFromCache($channelType, $channel['source'], $channelId);
            }
        }
    }

    // Debug
    // var_dump($channelId); exit;

    if (! empty($channelId)) {
        // Ok
        return (array(
            'id' => $channelId,
            'type' => $channelType,
        ));
    }
});

if (! empty($_GET['channel']) && isset($channels[$_GET['channel']])) {
    $channel = $channels[$_GET['channel']];

    if (! is_array($channel)) {
        $channel = (array(
            'source' => $channel,
        ));
    }

    $channelId = $getIdByChannel($channel);

    if (! empty($channelId)) {
        header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Pragma: no-cache");
        header("Cache-Control: no-cache, must-revalidate");

        if ($channelId['type'] == 'acelive') {
            header("Location: " . $acePrefixAcelive . "" . $channelId['id'] . ""); exit;
        }
        else {
            header("Location: " . $acePrefix . "" . $channelId['id'] . ""); exit;
        }
    }

    // Fail
    header("Status: 404 Not Found");
    header("Retry-After: 180");

    header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Pragma: no-cache");
    header("Cache-Control: no-cache, must-revalidate");

    exit("404 Channel Not Found");
}
