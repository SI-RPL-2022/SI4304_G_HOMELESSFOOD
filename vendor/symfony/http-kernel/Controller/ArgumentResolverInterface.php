<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * An ArgumentResolverInterface instance knows how to determine the
 * arguments for a specific action.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface ArgumentResolverInterface
{
    /**
     * Returns the arguments to pass to the controller.
     *
<<<<<<< HEAD
     * @return array
=======
     * @return array An array of arguments to pass to the controller
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @throws \RuntimeException When no value could be provided for a required argument
     */
    public function getArguments(Request $request, callable $controller);
}
