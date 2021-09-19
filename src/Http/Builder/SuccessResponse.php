<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http\Builder;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use ReflectionException;

class SuccessResponse extends ResponseBuilder
{
    /**
     * @param null $data
     * @param mixed ...$parameters
     * @return array|array[]|LengthAwarePaginator[]|null[]
     * @throws ReflectionException
     */
    function build($data = null, ...$parameters)
    {
        return $this->setData($data)
                    ->setParameters(...$parameters)
                    ->response();
    }
}
