<?php

namespace Dashifen\WPDebugging;

use Dashifen\Debugging\DebuggingTrait;

trait WPDebuggingTrait
{
  use DebuggingTrait;
  
  /**
   * isDebug
   *
   * Returns true if either the conditions of the DebuggingTrait are met or
   * if our WordPress environment has its WP_DEBUG flag set.
   *
   * @return bool
   */
  public static function isDebug(): bool
  {
    return DebuggingTrait::isDebug() || (defined('WP_DEBUG') && WP_DEBUG);
  }
  
  /**
   * writeLog
   *
   * Calling this method should write $data to the WordPress debug.log file.
   *
   * @param mixed $data
   *
   * @return void
   */
  public static function writeLog($data): void
  {
    // source:  https://www.elegantthemes.com/blog/tips-tricks/using-the-wordpress-debug-log
    // accessed:  2020-08-02
    
    if (!function_exists("write_log")) {
      function write_log($log)
      {
        if (is_array($log) || is_object($log)) {
          error_log(print_r($log, true));
        } else {
          error_log($log);
        }
      }
    }
    
    write_log($data);
  }
}
