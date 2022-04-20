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
 * Interface for HTTP error exceptions.
 *
 * @author Kris Wallsmith <kris@symfony.com>
 */
interface HttpExceptionInterface extends \Throwable
{
    /**
     * Returns the status code.
     *
<<<<<<< HEAD
     * @return int
=======
     * @return int An HTTP response status code
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getStatusCode();

    /**
     * Returns response headers.
     *
<<<<<<< HEAD
     * @return array
=======
     * @return array Response headers
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getHeaders();
}
