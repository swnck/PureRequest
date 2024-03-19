<?php

/*
 * Apache License
 * Version 2.0, January 2004
 * http://www.apache.org/licenses/
 *
 * Copyright (c) 2024 Nick Schweizer
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


namespace Swnck\PureRequest\http;

use Swnck\PureRequest\http\config\RequestConfiguration;
use Swnck\PureRequest\http\content\type\BodyContent;
use Swnck\PureRequest\http\frame\type\BodyFrame;
use Swnck\PureRequest\http\frame\type\HeaderFrame;
use Swnck\PureRequest\http\frame\type\ResponseFrame;
use Swnck\PureRequest\http\model\RequestModel;

class PureRequest {

    public function __construct(
        public ?RequestConfiguration $configuration = null
    ){}

    public function get(HeaderFrame $headers, callable $response, string $url = ""): void
    {
        $requestModel = new RequestModel($this);
        $modelInformation = $requestModel->build($headers, BodyContent::empty(), $url);

        $responseFrame = new ResponseFrame(
            $modelInformation->getStatusCode(),
            $modelInformation->getResponse()
        );

        $response($responseFrame);

    }

    public function post(HeaderFrame $headers, BodyFrame $frame, callable $response, string $url): void
    {

        $requestModel = new RequestModel($this);
        $modelInformation = $requestModel->build($headers, $frame, $url);

        $responseFrame = new ResponseFrame(
            $modelInformation->getStatusCode(),
            $modelInformation->getResponse()
        );

        $response($responseFrame);
    }

    /**
     * @return RequestConfiguration|null
     */
    public function getConfiguration(): ?RequestConfiguration
    {
        return $this->configuration;
    }
}