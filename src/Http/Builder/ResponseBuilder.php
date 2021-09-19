<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http\Builder;

use ApiResponse\Formatter\Helpers\ArrayService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Config;
use ReflectionException;

abstract class ResponseBuilder
{
    const __SUCCESS = 'success';
    const __MESSAGE = 'message';
    const  __STATUS = 'status';
    const __DATA_WRAPPING = 'always_data_wrapping';

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $status_ref;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var bool
     */
    protected $success;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param null $data
     * @param ...$parameters
     * @return array|array[]|LengthAwarePaginator[]|null[]
     */
    abstract function build($data = null, ...$parameters);

    /**
     * @return array
     */
    protected function getEnabledKeys(): array
    {
        $config = Config::get('api_response_format');
        $output = [];
        foreach ($config as $key => $value) {
            $value = filter_var($value, FILTER_VALIDATE_BOOL);
            if ($value == true) {
                $output[$key] = $key;
            }
        }

        return $output;
    }

    protected function isWrappingData(): bool
    {
        return true;
//        return in_array(self::__DATA_WRAPPING, $this->getEnabledKeys());
    }

    private function isArrayDefaultDataKeyType(): bool
    {
        return ArrayService::isArray(
            Config::get('api_response_format.data_key_default_type')
        );
    }

    /**
     * set default to status, ref, success, message
     */
    protected function setDefaultParametersValue()
    {
        if ($this instanceof SuccessResponse) {
            $this->status = getSuccessHttpStatusCode();
            $this->status_ref = getSuccessHttpStatusRef();
            $this->success = true;
            $this->message = 'success';
        } elseif ($this instanceof ErrorResponse) {
            $this->status = getErrorHttpStatusCode();
            $this->status_ref = getErrorHttpStatusRef();
            $this->success = false;
            $this->message = 'error';
        }
    }

    /**
     * @param ...$parameters
     * @return $this
     * @throws ReflectionException
     */
    protected function setParameters(...$parameters): self
    {
        $this->setDefaultParametersValue();

        foreach ($this->getEnabledKeys() as $key) {
            $parameter = ArrayService::get($parameters, '0', []);

            if ($key === self::__STATUS) {
                $statusCode = ArrayService::get($parameter, self::__STATUS, $this->status);
                $this->parameters = array_merge($this->parameters, [
                    $key          => $statusCode,
                    $key . '_ref' => getStatusRef($statusCode)
                ]);
            }
            if ($key === self::__SUCCESS) {
                $this->parameters = array_merge($this->parameters, [
                    $key => $this->success
                ]);
            }
            if ($key === self::__MESSAGE) {
                $this->parameters = array_merge($this->parameters, [
                    $key => ArrayService::get($parameter, self::__MESSAGE, $this->message)
                ]);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    protected function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param $data
     * @return $this
     */
    protected function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array|LengthAwarePaginator|null
     */
    protected function getData()
    {
        if (is_null($this->data)) {
            return null;
        }

        if ($this->data instanceof Arrayable &&
            !$this->data instanceof LengthAwarePaginator
        ) {
            return $this->data->toArray();
        }

        if ($this->data instanceof ResourceCollection || $this->data instanceof AnonymousResourceCollection) {
            return $this->data->response()->getData(true);
        }

        if (!is_array($this->data)) {
            return $this->data->toArray();
        }

        return $this->data;
    }

    protected function formattedData(): array
    {
        $data = $this->getData();
        if ($this->isArrayDefaultDataKeyType() && is_null($data)) {
            $data = array();
        }

        if (ArrayService::isArray($data) &&
            array_key_exists('data', $data)
        ) {
            return $data;
        }

        return [
            'data' => $data
        ];
    }

    protected function response()
    {
        return app(ResponseFactory::class)->json(
            array_merge($this->getParameters(), $this->formattedData())
        );
    }
}
