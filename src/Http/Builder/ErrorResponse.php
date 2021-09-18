<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http\Builder;

use ReflectionException;

class ErrorResponse extends ResponseBuilder
{
    /**
     * @throws ReflectionException
     */
    function build($data = null, ...$parameters)
    {
        return $this->setData($data)
                    ->setParameters(...$parameters)
                    ->render();
    }

    /**
     * @return array
     */
    protected function render()
    {
        return $this->response();
    }
}
