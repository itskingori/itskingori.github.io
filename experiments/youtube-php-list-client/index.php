<?php

// set the site root i.e. ../../.../kingori/
$site_root = dirname(dirname(dirname(__FILE__))).'/';

// gets the data from a URL
function get_url_contents($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

// add project config file
require_once $site_root.'experiments/youtube-php-list-client/config.php';

// initialize
$htmlBody = '';
$youtube_public_api   = 'http://gdata.youtube.com/feeds/api/users/'.$youtube_channel_name.'/uploads?alt=json';

// fetch data
$responce = get_url_contents($youtube_public_api);
$responce = json_decode($responce);
$videos = $responce->feed->entry;

// iterate through each video
$htmlBody .= '<ul>';
foreach ($videos as $video) {

    // extract the data
    $title      = ucwords($video->title->{'$t'});
    $link       = $video->link['0']->href;
    $thumbnail  = $video->{'media$group'}->{'media$thumbnail'}['0']->url;
    $time       = $video->{'media$group'}->{'yt$duration'}->seconds;

    // format the time appropriately
    if ($time > 3600) { $time_format = 'H:i:s'; } else { $time_format = 'i:s'; }
    $time = gmdate($time_format, $time);
    
    $htmlBody .= sprintf('<li><img src="%s" height="180" width="240"><a href="%s">%s (%s)</a></li>', $thumbnail, $link, $title, $time);
}
$htmlBody .= '</ul>';

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>
        
        <!--
         __/\\\________/\\\___________________________________/\\\\___________________________________        
          _\/\\\_____/\\\//___________________________________\///\\___________________________________       
           _\/\\\__/\\\//______/\\\_________________/\\\\\\\\___/\\/_______________________________/\\\_      
            _\/\\\\\\//\\\_____\///___/\\/\\\\\\____/\\\////\\\_\//________/\\\\\_____/\\/\\\\\\\__\///__     
             _\/\\\//_\//\\\_____/\\\_\/\\\////\\\__\//\\\\\\\\\__________/\\\///\\\__\/\\\/////\\\__/\\\_    
              _\/\\\____\//\\\___\/\\\_\/\\\__\//\\\__\///////\\\_________/\\\__\//\\\_\/\\\___\///__\/\\\_   
               _\/\\\_____\//\\\__\/\\\_\/\\\___\/\\\__/\\_____\\\________\//\\\__/\\\__\/\\\_________\/\\\_  
                _\/\\\______\//\\\_\/\\\_\/\\\___\/\\\_\//\\\\\\\\__________\///\\\\\/___\/\\\_________\/\\\_ 
                 _\///________\///__\///__\///____\///___\////////_____________\/////_____\///__________\///__
                  -->
                                  
        <!-- +++ META +++ -->
        <meta charset="utf-8">
        <meta name="robots" content="INDEX">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- +++ SITE INFO +++ -->
        <title>YouTube List Client | King'ori J. Maina</title>

    </head>
    
    <body>
        <?=$htmlBody?>
    </body>
</html>