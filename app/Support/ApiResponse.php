<?php

namespace App\Support;

use App\Traits\HasResponseCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    use HasResponseCode;

    /**
     * Api status (if success is true, else false)
     */
    private $status;

    /**
     * HTTP Response Status Code
     */
    private $status_code = Response::HTTP_OK;

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

    public function setData(array $data = []): self
    {
        if (!empty($data)) {

            array_walk_recursive($data, function (&$value, $key) {

                $value = is_null($value) ? "" : $value;
            });

            $this->data = $data;
        };

        return $this;
    }

    public function setError(array $error = []): self
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
        return [
            'status'    =>  $this->status,
            'message' => $this->message,
            'data'      =>  $this->data ?? [],
            'error'     =>  $this->error ?? []
        ];
    }

    public function toJson(): JsonResponse
    {
        return response()->json($this->toArray(), $this->status_code);
    }

    public function toSuccessJson(): JsonResponse
    {
        return $this->setSuccessStatus()->toJson();
    }

    public function toFailJson(): JsonResponse
    {
        return $this->setFailStatus()->toJson();
    }
}
