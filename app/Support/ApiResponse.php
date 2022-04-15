<?php

namespace App\Support;

use App\Traits\HasApiLog;
use App\Traits\HasResponseCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    use HasResponseCode,
        HasApiLog;

    /**
     * Api status (if success is true, else false)
     */
    private $status;

    /**
     * HTTP Response Status Code
     */
    private $statusCode = Response::HTTP_OK;

    /**
     * Return string $message
     */
    private $message = 'Ok';

    /**
     * Return data
     */
    private $data = [];

    /**
     * Return errors
     */
    private $error = [];

    /** Paginations */
    private $pagination = [];

    /** Enable activity log */
    private $enableLog = false;

    /**
     * Constants
     */
    const STATUS_SUCCESS = 'success';

    const STATUS_FAIL = 'fail';

    public function setMessage(string $message = 'Ok', bool $flash = false): self
    {
        $this->message = $message;

        if ($flash) {
            request()->session()
                ->flash($this->status, $this->message);
        }

        return $this;
    }

    public function setData(array $data): self
    {
        if (!empty($data)) {

            array_walk_recursive($data, function (&$value, $key) {

                $value = is_null($value) ? "" : $value;
            });

            $this->data = $data;
        };

        return $this;
    }

    public function setError(array $error): self
    {
        $this->error = $error;

        return $this;
    }

    protected function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setSuccessStatus(): self
    {
        return $this->setStatus(self::STATUS_SUCCESS);
    }


    public function setFailStatus(): self
    {
        return $this->setStatus(self::STATUS_FAIL);
    }

    public function toArray(): array
    {
        $data = [
            'status' =>  $this->status,
            'message' => $this->message,
        ];

        if (empty($this->error)) {
            return $data += [
                'data' =>  $this->data,
            ];
        }

        return $data += [
            'error' =>  $this->error
        ];
    }

    public function toJson(): JsonResponse
    {
        if ($this->enableLog) {
            $this->setProperties([
                'header' => request()->header(),
                'request' => request()->except(['_method', '_token', 'password']),
                'response' => $this->toArray()
            ])->saveApiLog($this->message);
        }

        return response()->json($this->toArray() + $this->pagination, $this->statusCode);
    }

    public function toSuccessJson(): JsonResponse
    {
        return $this->setSuccessStatus()->toJson();
    }

    public function toFailJson(): JsonResponse
    {
        return $this->setFailStatus()->toJson();
    }

    public function withLog(Model $subject, Model $causer = null, $action = 'list')
    {
        $this->enableLog = true;

        $this->setSubject($subject)
            ->setCauser($causer ?? request()->user())
            ->setMessage(trans('messages.api.' . $action, ['module' => basename(get_class($subject))]));

        return $this;
    }

    public function setPagination(array $pagination)
    {
        if (!empty($pagination)) {

            array_walk_recursive($pagination, function (&$value, $key) {

                $value = is_null($value) ? "" : $value;
            });

            $this->pagination = $pagination;
        };

        return $this;
    }
}
