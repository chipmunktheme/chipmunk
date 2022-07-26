<?php

namespace Chipmunk\Helper;

/**
 * Provides methods to run file-related tasks
 */
trait FileTrait {

	/**
	 * Builds a file path with the appropriate directory separator.
	 *
	 * @param string[] $segments,... unlimited number of path segments
	 *
	 * @return string Path
	 */
	public function buildPath( ...$segments ): string {
		return join( DIRECTORY_SEPARATOR, $segments );
	}
}
