<?php

namespace Dashifen\Repository;

use Dashifen\Exception\Exception;

class RepositoryException extends Exception
{
  // normally, Dashifen\Exception constant values start at one, since the
  // parent class uses zero as the UNKNOWN_ERROR constant value.  but, since
  // we expect children to extend this further, we'll let them start at one
  // and use negative one and two here instead.
  
  public const UNKNOWN_PROPERTY = -1;
  public const UNKNOWN_SETTER = -2;
  public const INVALID_VALUE = -3;
  public const DUPLICATE_PROPERTIES = -4;
  public const EMPTY_REQUIREMENTS = -5;
}
