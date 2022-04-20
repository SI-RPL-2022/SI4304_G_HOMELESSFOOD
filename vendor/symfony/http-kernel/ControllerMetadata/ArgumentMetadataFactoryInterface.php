<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\ControllerMetadata;

/**
 * Builds method argument data.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
interface ArgumentMetadataFactoryInterface
{
    /**
<<<<<<< HEAD
     * @param string|object|array $controller The controller to resolve the arguments for
=======
     * @param mixed $controller The controller to resolve the arguments for
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @return ArgumentMetadata[]
     */
    public function createArgumentMetadata($controller);
}
