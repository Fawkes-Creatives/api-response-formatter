<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http\Builder;

class ErrorResponse extends ResponseBuilder
{
    function build($data = null, ...$parameters)
    {
        return $this->setData($data)
                    ->setParameters(...$parameters)
                    ->render();
    }

    protected function render()
    {
        return array_merge($this->getParameters(), [
            'data' => $this->getData()
        ]);
    }
}
