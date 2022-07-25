<?php

namespace Dashifen\Debugging;

use Throwable;

trait DebuggingTrait
{
  /**
   * debug
   *
   * Given stuff, print information about it and then die() if the $die flag is
   * set.  Typically, this only works when the isDebug() method returns true,
   * but the $force parameter will override this behavior.
   *
   * @param mixed $stuff
   * @param bool  $die
   * @param bool  $force
   *
   * @return void
   */
  public static function debug($stuff, bool $die = false, bool $force = false): void
  {
    if (self::isDebug() || $force) {
      $message = "<pre>" . print_r($stuff, true) . "</pre>";
      
      if (!$die) {
        echo $message;
        return;
      }
      
      die($message);
    }
  }
  
  /**
   * isDebug
   *
   * Returns true in a debug-able environment.
   *
   * @return bool
   */
  public static function isDebug(): bool
  {
    return defined('DASHIFEN_DEBUG') && DASHIFEN_DEBUG;
  }
  
  /**
   * catcher
   *
   * This serves as a general-purpose Exception handler which displays
   * the caught object when we're debugging and writes it to the log when
   * we're not.
   *
   * @param Throwable $thrown
   *
   * @return void
   */
  public static function catcher(Throwable $thrown): void
  {
    self::isDebug() ? self::debug($thrown, true) : self::writeLog($thrown);
  }
  
  /**
   * writeLog
   *
   * Writes information about our parameter to the PHP log.  Ideally, this is
   * a Throwable, but it doesn't really matter what it is.
   *
   * @param mixed $thrown
   */
  public static function writeLog($thrown): void
  {
    $error = is_array($thrown) || is_object($thrown)
      ? print_r($thrown, true)
      : $thrown;
    
    error_log($error);
  }
}
