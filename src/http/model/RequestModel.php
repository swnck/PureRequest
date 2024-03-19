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

namespace Swnck\PureRequest\http\model;

use Swnck\PureRequest\http\frame\type\BodyFrame;
use Swnck\PureRequest\http\frame\type\HeaderFrame;
use Swnck\PureRequest\http\model\information\ModelInformation;
use Swnck\PureRequest\http\PureRequest;
use Swnck\PureRequest\http\util\StatusCode;


class RequestModel implements Model
{
    public function __construct(
        private PureRequest $request,
    ) {}

    public function build(HeaderFrame $headerFrame, BodyFrame $frame, string $url = ""): ModelInformation
    {
        if ($url === "") return new ModelInformation();

        $headers = [];
        foreach ($headerFrame->getHeaders() as $key => $value) {
            if ($value instanceof \UnitEnum) {
                $value = $value->value;
            }
            $headers[] = "$key: $value";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $this->request->getConfiguration()->isReturnTransfer());
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $this->request->getConfiguration()->isFollowLocation());
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->request->getConfiguration()->getTimeout());
        curl_setopt($ch, CURLOPT_MAXREDIRS, $this->request->getConfiguration()->getMaxRedirects());
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        if ($frame->getBody() != []) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($frame->getBody()));
        }

        $response = curl_exec($ch);

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $statusCode = StatusCode::getStatusCodeEnum($code);

        try {
            if (curl_errno($ch)) throw new \Exception(curl_error($ch)); //Logical error
        } catch (\Exception $ignore) {
            var_dump($ignore->getMessage());
        }

        curl_close($ch);
        return new ModelInformation($statusCode, $response);
    }
}