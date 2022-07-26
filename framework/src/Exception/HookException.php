<?php

namespace Piotrkulpinski\Framework\Exception;

use Piotrkulpinski\Framework\Exception\Exception;

/**
 * Class HookException
 */
class HookException extends Exception {
	public const FAILURE_TO_CONSTRUCT   = 1;
	public const INVALID_ARGUMENT_COUNT = 2;
}
