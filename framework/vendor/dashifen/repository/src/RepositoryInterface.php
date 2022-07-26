<?php

namespace Dashifen\Repository;

use Iterator;
use JsonSerializable;

interface RepositoryInterface extends JsonSerializable, Iterator
{
  /**
   * toArray
   *
   * Returns the non-hidden protected properties of this object as an
   * associative array mapping property name to value.
   *
   * @return array
   */
  public function toArray(): array;
}
