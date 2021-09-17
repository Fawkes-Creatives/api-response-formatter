<?php
/**
 * @author fawkescreatives created on 15/09/2021
 */

namespace ApiResponse\Formatter\Http\Builder;

use ApiResponse\Formatter\Helpers\ArrayService;
use ApiResponse\Formatter\Helpers\HtmlStatusCode;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Config;

abstract class ResponseBuilder
{
    const __SUCCESS = 'success';
    const __MESSAGE = 'message';
    const  __STATUS = 'status';
    const __DATA_WRAPPING = 'always_data_wrapping';

    protected $parameters = [];

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var bool
     */
    protected $success;

    protected $data;

    protected $htmlStatusClassFromRoot = 'App\Http\HtmlStatusCode';

    /**
     * @param null $data
     * @param ...$parameters
     * @return array|array[]|LengthAwarePaginator[]|null[]
     */
    abstract function build($data = null, ...$parameters);

    /**
     * @return array|ResourceCollection
     */
    abstract protected function render();

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

    /**
     * @return HtmlStatusCode|mixed
     */
    protected function getHtmlStatusCode()
    {
        if (class_exists($this->htmlStatusClassFromRoot)) {
            return new $this->htmlStatusClassFromRoot;
        }

        return new HtmlStatusCode();
    }

    protected function setDefaultParametersValue()
    {
        if ($this instanceof SuccessResponse) {
            $this->status = $this->getHtmlStatusCode()::SUCCESS;
            $this->success = true;
            $this->message = 'success';
        } elseif ($this instanceof ErrorResponse) {
            $this->status = $this->getHtmlStatusCode()::BAD_REQUEST;
            $this->success = false;
            $this->message = 'error';
        }
    }

    /**
     * @param ...$parameters
     * @return $this
     */
    protected function setParameters(...$parameters): self
    {
        $this->setDefaultParametersValue();

        foreach ($this->getEnabledKeys() as $key) {
            $parameter = ArrayService::get($parameters, '0', []);
            if ($key === self::__STATUS) {
                $this->parameters = array_merge($this->parameters, [
                    $key => ArrayService::get($parameter, self::__STATUS, $this->status)
                ]);
            }
            if ($key === self::__SUCCESS) {
                $this->parameters = array_merge($this->parameters, [
                    $key => ArrayService::get($parameter, self::__SUCCESS, $this->success)
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
            $this->data = $this->data->toArray();
        }

        return $this->data;
    }
}
