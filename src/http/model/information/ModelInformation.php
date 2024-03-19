<?php

namespace Swnck\PureRequest\http\model\information;

use Swnck\PureRequest\http\util\StatusCode;

class ModelInformation
{
    public function __construct(
        private ?StatusCode $statusCode = StatusCode::NotFound,
        private ?string $response = ""
    ) {}


    /**
     * @return StatusCode
     */
    public function getStatusCode(): StatusCode
    {
        return $this->statusCode;
    }

    /**
     * @param StatusCode $statusCode
     */
    public function setStatusCode(StatusCode $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }
}