<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Exception;

/**
 * @author Ben Ramsey <ben@benramsey.com>
 */
class UnauthorizedHttpException extends HttpException
{
    /**
<<<<<<< HEAD
     * @param string          $challenge WWW-Authenticate challenge string
     * @param string|null     $message   The internal exception message
     * @param \Throwable|null $previous  The previous exception
     * @param int|null        $code      The internal exception code
     */
    public function __construct(string $challenge, ?string $message = '', \Throwable $previous = null, ?int $code = 0, array $headers = [])
=======
     * @param string     $challenge WWW-Authenticate challenge string
     * @param string     $message   The internal exception message
     * @param \Throwable $previous  The previous exception
     * @param int        $code      The internal exception code
     */
    public function __construct(string $challenge, string $message = null, \Throwable $previous = null, ?int $code = 0, array $headers = [])
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
    {
        if (null === $message) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'Passing null as $message to "%s()" is deprecated, pass an empty string instead.', __METHOD__);

            $message = '';
        }
        if (null === $code) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'Passing null as $code to "%s()" is deprecated, pass 0 instead.', __METHOD__);

            $code = 0;
        }

        $headers['WWW-Authenticate'] = $challenge;

        parent::__construct(401, $message, $previous, $headers, $code);
    }
}
