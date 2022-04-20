<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

/**
 * Request stack that controls the lifecycle of requests.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class RequestStack
{
    /**
     * @var Request[]
     */
    private $requests = [];

    /**
     * Pushes a Request on the stack.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     */
    public function push(Request $request)
    {
        $this->requests[] = $request;
    }

    /**
     * Pops the current request from the stack.
     *
     * This operation lets the current request go out of scope.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     *
     * @return Request|null
     */
    public function pop()
    {
        if (!$this->requests) {
            return null;
        }

        return array_pop($this->requests);
    }

    /**
     * @return Request|null
     */
    public function getCurrentRequest()
    {
        return end($this->requests) ?: null;
    }

    /**
     * Gets the master Request.
     *
     * Be warned that making your code aware of the master request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * @return Request|null
     */
    public function getMasterRequest()
    {
        if (!$this->requests) {
            return null;
        }

        return $this->requests[0];
    }

    /**
     * Gets the master request.
     *
     * @return Request|null
     *
     * @deprecated since symfony/http-foundation 5.3, use getMainRequest() instead
     */
    public function getMasterRequest()
    {
        trigger_deprecation('symfony/http-foundation', '5.3', '"%s()" is deprecated, use "getMainRequest()" instead.', __METHOD__);

        return $this->getMainRequest();
    }

    /**
     * Returns the parent request of the current.
     *
     * Be warned that making your code aware of the parent request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
<<<<<<< HEAD
     * If current Request is the main request, it returns null.
=======
     * If current Request is the master request, it returns null.
>>>>>>> dd4d141e796b9f4c10db739ea539a502f00e161f
     *
     * @return Request|null
     */
    public function getParentRequest()
    {
        $pos = \count($this->requests) - 2;

        if (!isset($this->requests[$pos])) {
            return null;
        }

        return $this->requests[$pos];
    }
}
