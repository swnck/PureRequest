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

use Swnck\PureRequest\http\config\RequestConfiguration;
use Swnck\PureRequest\http\content\type\BodyContent;
use Swnck\PureRequest\http\content\type\HeaderContent;
use Swnck\PureRequest\http\frame\type\ResponseFrame;
use Swnck\PureRequest\http\PureRequest;
use Swnck\PureRequest\http\util\ContentType;

class BasePureRequest
{
    public function __construct()
    {
        //Tests:
        $request = new PureRequest((new RequestConfiguration())
            ->setReturnTransfer(true)
        );

        $request->get(HeaderContent::empty(), function (ResponseFrame $response) {
            echo $response->getContent();
        }, "url");

        $request->post(HeaderContent::paste(["Content-Type" => ContentType::APPLICATION_JSON]), BodyContent::paste([
            "email" => "",
            "password" => ""
        ]), function (ResponseFrame $response) {
            echo $response->getContent();
        }, "url");

        $request->post(HeaderContent::paste(["Content-Type" => ContentType::APPLICATION_JSON, "Connection" => "keep-alive"]), BodyContent::empty(), function (ResponseFrame $response) {
            echo $response->getContent();
            echo $response->getStatusCode();
        }, "url");

        $request->post(HeaderContent::empty(), BodyContent::empty(), function (ResponseFrame $response) {
            echo $response->getContent();
            echo $response->getStatusCode();
        }, "url");
    }
}