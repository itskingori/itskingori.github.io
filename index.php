<?php

# Check if we are running an unsupported version of PHP
if (phpversion() < 5) {
  
  die('<h3>Requires PHP/5.0 or higher.<br>You are currently running PHP/'.phpversion().'.</h3>');

}
else {

  # require helpers class so we can use rglob
  require_once './app/helpers.inc.php';

  # include any php files which sit in the app folder
  foreach(Helpers::rglob('./app/**.inc.php') as $include) include_once $include;

  # start the app
  new Stacey($_GET);
  
}

?>