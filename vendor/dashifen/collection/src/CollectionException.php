<?php

namespace Dashifen\Collection;

use Dashifen\Exception\Exception;

class CollectionException extends Exception
{
  public const INVALID_KEY   = 1;
  public const INVALID_VALUE = 2;
}
