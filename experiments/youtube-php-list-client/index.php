<?php

// set the site root i.e. ../../.../kingori/
$site_root = dirname(dirname(dirname(__FILE__))).'/';

// add config & youtube library files
require_once $site_root.'experiments/config.php'; // global
require_once $site_root.'experiments/youtube-php-list-client/config.php'; // project specific
require_once $site_root.'public/php/google-api-php-client/src/Google_Client.php';
require_once $site_root.'public/php/google-api-php-client/src/contrib/Google_YouTubeService.php';

// set cached access token. Remember to replace $_SESSION with a real database
// or memcached.
session_start();

$client = new Google_Client();

// use API keys to identify your project when you do not need to access user data.
// $client->setDeveloperKey($google_api_key);

// set the redirect url
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);

// Use client details if you need to access user data.
$client->setClientId($project_oauth2_client_id);
$client->setClientSecret($project_oauth2_client_secret);
$client->setRedirectUri($redirect);

$youtube = new Google_YoutubeService($client);

if (isset($_GET['code'])) {

    if (strval($_SESSION['state']) !== strval($_GET['state'])) {

        die('The session state did not match.');
    }

    $client->authenticate();
    $_SESSION['token'] = $client->getAccessToken();
    header('Location: ' . $redirect);
}

if (isset($_SESSION['token'])) {

    $client->setAccessToken($_SESSION['token']);
}

// Check if access token successfully acquired
if ($client->getAccessToken()) {

    try {

        $htmlBody .= 'authorized';

    }
    catch (Google_ServiceException $e) {

        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
    }
    catch (Google_Exception $e) {

        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
        htmlspecialchars($e->getMessage()));
    }

    $_SESSION['token'] = $client->getAccessToken();
}
else {

      // If the user hasn't authorized the app, initiate the OAuth flow
      $state = mt_rand();
      $client->setState($state);
      $_SESSION['state'] = $state;

      $authUrl = $client->createAuthUrl();
      $htmlBody = <<<END
  <h3>Authorization Required</h3>
  <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
END;
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
        <title>YouTube List Client | King'ori J. Maina</title>

    </head>
    
    <body>
        <?=$htmlBody?>
    </body>
</html>