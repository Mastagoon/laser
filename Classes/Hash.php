<?php

Class Hash {
  public static function make($string) {
    return password_hash($string,PASSWORD_DEFAULT);
  }

}
