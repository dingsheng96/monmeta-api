<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait HasResponseCode
{
    public function setStatusCode($status_code): self
    {
        $this->status_code = $status_code;

        return $this;
    }

    public function getStatusCode()
    {
        return $this->status_code;
    }

    public function setOkStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_OK);

        return $this;
    }

    public function setBadRequestStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_BAD_REQUEST);

        return $this;
    }

    public function setUnauthorizedStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_UNAUTHORIZED);

        return $this;
    }

    public function setForbiddenStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_FORBIDDEN);

        return $this;
    }

    public function setNotFoundStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_NOT_FOUND);

        return $this;
    }

    public function setUnprocessableEntityStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $this;
    }

    public function setInternalServerErrorStatusCode(): self
    {
        $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        return $this;
    }
}
