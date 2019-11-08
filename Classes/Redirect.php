<?php

Class Redirect {
  public static function to($path) {
    header("Location: " . $path);
  }
}
