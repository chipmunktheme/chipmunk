<?php

namespace Dashifen\Collection;

use Iterator;
use ArrayAccess;

interface CollectionInterface extends Iterator, ArrayAccess
{
  /**
   * getCollection
   *
   * Returns the entire collection.
   *
   * @return array
   */
  public function getCollection(): array;
  
  /**
   * resetCollection
   *
   * Resets the entire collection.
   *
   * @return void
   */
  public function resetCollection(): void;
}
