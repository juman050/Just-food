<?php

namespace App\Http\Helpers;

class PostcodeHelper{

  /*
  |-----------------------------------------
  | Postcode Helper
  |-----------------------------------------
  |
  | 
  | Author : Juman Ahmed
  | Helper : Postcode Helper for Just-food Website
  | Version : 1.0.0
  |
  */


  // define a regular expression that matches the general format for postcodes
  const REGULAR_EXPRESSION =
      '/^([Gg][Ii][Rr]0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))[0-9][A-Za-z]{2})$/';

  // define the field lengths in the database
  const DISTRICT_LENGTH  = 4;
  const POST_TOWN_LENGTH = 22;
  const RECORD_LENGTH    = 26;

  // declare the path to the database
  private static $databasePath;

  public static function isValidFormat($postcode){

    // return whether the postcode is in a valid format
    return preg_match(self::REGULAR_EXPRESSION, strtoupper($postcode));

  }

  private static function parse($postcode){

    // parse the postcode and return the result
    preg_match(self::REGULAR_EXPRESSION, strtoupper($postcode), $matches);
    return $matches;

  }

}

?>
