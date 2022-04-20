<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Cloner;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
interface ClonerInterface
{
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
<<<<<<< HEAD
     * @return Data
=======
     * @return Data The cloned variable represented by a Data object
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     */
    public function cloneVar($var);
}
