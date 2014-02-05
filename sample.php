<?php

  ini_set('display_errors',1);
  ini_set('display_startup_errors',1);
  error_reporting(-1);

  include_once "remetric.php";
  
  $r = new Remetric("IPvBEuGI9Znf3245Z0cjIi6yvsIgTpXUizh8qVlmB5n4oO8N", true);
  echo $r->track( array( 
      "description" => "This is the description of {{ what }}.", 
      "what" => "awesome moment",
      "contact" => array( 
        "awesome" => 1, 
        "key" => "dallas" 
      ) 
    ) );
    
?>