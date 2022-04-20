<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing;

interface RequestContextAwareInterface
{
    /**
     * Sets the request context.
     */
    public function setContext(RequestContext $context);

    /**
     * Gets the request context.
     *
<<<<<<< HEAD
     * @return RequestContext
=======
     * @return RequestContext The context
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function getContext();
}
