<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http;

use ApiResponse\Formatter\Contracts\ResponseContract;
use ApiResponse\Formatter\Http\Builder\SuccessResponse;
use ApiResponse\Formatter\Http\Builder\ErrorResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Traits\Macroable;

class ResponseService implements ResponseContract
{
    use Macroable;

    /**
     * @var SuccessResponse
     */
    protected $successResponse;

    /**
     * @var ErrorResponse
     */
    protected $errorResponse;

    /**
     * @param SuccessResponse $successResponse
     * @param ErrorResponse $errorResponse
     */
    public function __construct(SuccessResponse $successResponse, ErrorResponse $errorResponse)
    {
        $this->successResponse = $successResponse;
        $this->errorResponse = $errorResponse;
    }

    /**
     * @param null $data
     * @param mixed ...$parameters
     * @return array|array[]|LengthAwarePaginator[]|null[]
     */
    public function success($data = null, ...$parameters)
    {
        return $this->successResponse->build($data, ...$parameters);
    }

    public function error($status = null, $message = null, $data = null)
    {
        return $this->errorResponse->build($data, [
            'status'  => $status,
            'message' => $message
        ]);
    }
}
