<?php 

/*

Track your users events via Remetric.com.

Example usage:

$r = new Remetric("IPvBEuGI9Znf3245Z0cjIi6yvsIgTpXUizh8qVlmB5n4oO8N");

Simply ping an event to Remetric:

  $json_response = $r->track( array( 
    "description" => "This is the description of {{ what }}.", 
    "what" => "awesome moment",
    "remetric_created_at" => 1391130336,
    "contact" => array( 
      "awesome" => 1, 
      "key" => "dallas" 
    ) 
  ) );

Use an 1x1 blank gif image tag:

  echo $r->img( array( 
    "description" => "This is the description of {{ what }}.", 
    "what" => "awesome moment",
    "remetric_created_at" => 1391130336,
    "contact" => array( 
      "awesome" => 1, 
      "key" => "dallas" 
    ) 
  ) );

Generate a redirect link:

  $link = $r->redirect( array( 
    "description" => "This is the description of {{ what }}.", 
    "what" => "awesome moment",
    "remetric_created_at" => 1391130336,
    "contact" => array( 
      "awesome" => 1, 
      "key" => "dallas" 
    ) 
  ) );

*/

class Remetric {
  public static $remetric_instance;
  
  public function __construct($api_key, $sandbox = false) {
    global $remetric_domain;
    global $remetric_api_key;
    $remetric_api_key = $api_key;
    $remetric_domain = "https://secure.remetric.com";
    if ($sandbox) { $remetric_domain = "http://localhost:3000"; }
  }
  
  public static function track($data) {
    // required description, contact.key
    global $remetric_domain;
    global $remetric_api_key;
    
    $query = array(
      "remetric_api_key" => $remetric_api_key,
      "event" => $data 
    );
    
    $ch = curl_init("$remetric_domain/events.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
    $r = curl_exec($ch);
    
    return $r;
  }
  
  public static function img($data) {
    // required description, contact.key
    global $remetric_domain;
    global $remetric_api_key;
    $base64 = Remetric::to_base64($data);
    $src = "$remetric_domain/events/img/$base64";
    $img = "<img src=\"$src\" style=\"display: none; \">";
    return $img;
  }
  
  public static function redirect($data) {
    // required description, redirect, contact.key
    global $remetric_domain;
    global $remetric_api_key;
    $base64 = Remetric::to_base64($data);
    $href = "$remetric_domain/events/redirect/$base64";
    return $href;
  }
  
  private static function to_base64($data) {
    global $remetric_api_key;
    $data["remetric_api_key"] = $remetric_api_key;
    return base64_encode(json_encode($data));
  }
}

?>