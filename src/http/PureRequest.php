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

use Swnck\PureRequest\http\frame\PureResponseFrame;
use Swnck\PureRequest\http\misc\body\BodyFrame;
use Swnck\PureRequest\http\misc\header\HeaderFrame;
use Swnck\PureRequest\http\util\Method;
use Swnck\PureRequest\http\util\StatusCode;

class PureRequest {

    public function get(HeaderFrame $headers, callable $response, string $url = ""): void
    {

        $responseFrame = new PureResponseFrame(
            StatusCode::Accepted,
            "sss"
        );
        var_dump($headers);
        $response($responseFrame);

    }

    public function post(HeaderFrame $headers, BodyFrame $frame, callable $response, string $url = "")
    {

        $responseFrame = new PureResponseFrame(
            StatusCode::Accepted,
            "post loco"
        );
        $response($responseFrame);
    }
}