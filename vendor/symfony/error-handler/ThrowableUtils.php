<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ErrorHandler;

/**
 * @internal
 */
class ThrowableUtils
{
<<<<<<< HEAD
    /**
     * @param SilencedErrorContext|\Throwable
     */
    public static function getSeverity($throwable): int
=======
    public static function getSeverity(\Throwable $throwable): int
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    {
        if ($throwable instanceof \ErrorException) {
            return $throwable->getSeverity();
        }

        if ($throwable instanceof \ParseError) {
            return \E_PARSE;
        }

        if ($throwable instanceof \TypeError) {
            return \E_RECOVERABLE_ERROR;
        }

        return \E_ERROR;
    }
}
