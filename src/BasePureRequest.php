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


namespace Swnck\PureRequest;

use Swnck\PureRequest\http\frame\PureResponseFrame;
use Swnck\PureRequest\http\misc\body\BodyContent;
use Swnck\PureRequest\http\misc\header\HeaderContent;
use Swnck\PureRequest\http\PureRequest;
use Swnck\PureRequest\http\util\ContentType;

class BasePureRequest
{
    public function __construct()
    {

        //Tests:
        $request = new PureRequest();

        $request->get(HeaderContent::paste(["Content-Type" => ContentType::APPLICATION_JSON]), function (PureResponseFrame $response) {
            echo $response->getContent();
        });

        $request->post(HeaderContent::paste(["Content-Type" => ContentType::APPLICATION_JSON]), BodyContent::empty(), function (PureResponseFrame $response) {
            echo $response->getContent();
        });
    }
}