<?php
class Token {


/**
 * Generates a token value
 *
 * param: connection to database ''$conn'
 *
 * return: token
 */
public static function generate(){
return $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));

}


/**
 * Checks if token parameter is equal to session token
 *
 * param: connection to database ''$conn'
 *
 * return: True if token values are equal, false otherwise
 */
  public static function check($token){
  if(isset($_SESSION['token']) && $token === $_SESSION['token']){
unset($_SESSION['token']);
return true;
  }
  return False;
  }



}

 ?>
