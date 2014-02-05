<?php

  include_once "remetric.php";
  
  $r = new Remetric("VOTLf12Xko7afb1tnxBiZWMgU8AI3NjLIC8ZM5hV97eHf8");
  echo $r->redirect( array( 
      "description" => "This is the description of the {{ what }}.", 
      "what" => "your moment",
      "contact" => array( 
        "awesome" => 1, 
        "key" => "dallas" 
      ) 
    ) );
    
?>