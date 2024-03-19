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

namespace Swnck\PureRequest\http\frame\type;

use Swnck\PureRequest\http\frame\Frame;
use Swnck\PureRequest\http\util\StatusCode;

class ResponseFrame implements Frame
{
    public function __construct(
        private readonly StatusCode $statusCode,
        private readonly string $content
    ) {}

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return StatusCode
     */
    public function getStatusCodeObject(): StatusCode
    {
        return $this->statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->getStatusCodeObject()->value;
    }
}