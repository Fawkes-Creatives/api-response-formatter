<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace LaravelIntuition\Contracts;

interface ResponseContract
{
    /**
     * @param null $data
     * @param ...$parameters
     * @return array
     */
    public function success($data = null, ...$parameters);

    /**
     * @param null $status
     * @param null $message
     * @return mixed
     */
    public function error($status = null, $message = null, $data = null);
}
