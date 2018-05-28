<?php
//ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1434638131-63pXnUHREktbexmeu7VShRt1tDywQ4k8qYN38Zz",
    'oauth_access_token_secret' => "7QW9xVQGzynFS8NZYU2WSxqNbYTsRtlK02vlfJqxkFEDS",
    'consumer_key' => "o6jymzyeBcxmDIYX3fNYlkj91",
    'consumer_secret' => "cqzK1HME4IqBsKinjnMW6n6hmUr7edaLYiFszZ8VlDI7WBBKD2"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
 
$requestMethod = "GET";
 
$getfield = '?screen_name=qiujumper&count=20';
 
$twitter = new TwitterAPIExchange($settings);
// echo $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();

//var_dump($twitter);

?>