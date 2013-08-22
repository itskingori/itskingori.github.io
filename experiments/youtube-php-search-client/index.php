<?php

// set the site root i.e. ../../.../kingori/
$site_root = dirname(dirname(dirname(__FILE__))).'/';

// add config & youtube library files
require_once $site_root.'experiments/config.php';
require_once $site_root.'public/php/google-api-php-client/src/Google_Client.php';
require_once $site_root.'public/php/google-api-php-client/src/contrib/Google_YouTubeService.php';

// set cached access token. Remember to replace $_SESSION with a real database
// or memcached.
session_start();

$client = new Google_Client();

// use API keys to identify your project when you do not need to access user data.
$client->setDeveloperKey($google_api_key);

// Use client details if you need to access user data.
// $client->setClientId($google_oauth2_client_id);
// $client->setClientSecret($google_oauth2_client_secret);

$youtube = new Google_YoutubeService($client);

// fetch query parameters
$query = null;
if (array_key_exists('q', $_GET)) { $query = $_GET['q']; }
$maxResults = null;
if (array_key_exists('maxResults', $_GET)) { $maxResults = $_GET['maxResults']; }

// initialize variables
$videos = '';

if ($query && $maxResults) {

    try {

        $search_response = $youtube->search->listSearch('id,snippet', array(
            'q' => $query,
            'maxResults' => $maxResults,
        ));

        foreach ($search_response['items'] as $search_result) {

            switch ($search_result['id']['kind']) {

                case 'youtube#video':
                    $videos .= sprintf('<a href="https://www.youtube.com/watch?v=%s">%s</a><br/>', $search_result['id']['videoId'], $search_result['snippet']['title']);
                break;
            }
        }
    }
    catch (Google_ServiceException $e) {

        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
    }
    catch (Google_Exception $e) {

        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
    }
}
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
        <title>YouTube Search Client | King'ori J. Maina</title>

    </head>
    
    <body>

        <form action="" method="get">
            <input type="search" name="q" value="<?=$query?>" placeholder="Search YouTube"><br>
            <input type="number" name="maxResults" min="0" max="10" value="5"><br>
            <input type="submit" value="Submit">
        </form>

        <?=$videos?>

    </body>
</html>