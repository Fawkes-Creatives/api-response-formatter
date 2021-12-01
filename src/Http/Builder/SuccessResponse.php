<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace LaravelIntuition\Http\Builder;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use ReflectionException;

class SuccessResponse extends ResponseBuilder
{
    /**
     * @param null $data
     * @param mixed ...$parameters
     * @return \Illuminate\Http\JsonResponse
     * @throws ReflectionException
     */
    function build($data = null, ...$parameters): \Illuminate\Http\JsonResponse
    {
        return $this->setData($data)
                    ->setParameters(...$parameters)
                    ->response();
    }
}
