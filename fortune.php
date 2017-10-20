<?php

require_once('auth.php');
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => OAUTH_TOKEN,
    'oauth_access_token_secret' => OAUTH_TOKEN_SECRET,
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET
);

$fortune = shell_exec('/usr/games/fortune -a -s -n 140');
$postfields = array(
    'status' => trim(preg_replace('/\s+/', ' ', $fortune))
);

$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();
