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

namespace Swnck\PureRequest\http\config;

class RequestConfiguration
{
    private bool $returnTransfer = true;
    private bool $followLocation = true;
    private int $timeout = 30;
    private int $maxRedirects = 10;

    public function setFollowLocation(bool $followLocation): RequestConfiguration
    {
        $this->followLocation = $followLocation;
        return $this;
    }

    public function setMaxRedirects(int $maxRedirects): RequestConfiguration
    {
        $this->maxRedirects = $maxRedirects;
        return $this;
    }

    public function setReturnTransfer(bool $returnTransfer): RequestConfiguration
    {
        $this->returnTransfer = $returnTransfer;
        return $this;
    }

    public function setTimeout(int $timeout): RequestConfiguration
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFollowLocation(): bool
    {
        return $this->followLocation;
    }

    /**
     * @return bool
     */
    public function isReturnTransfer(): bool
    {
        return $this->returnTransfer;
    }

    /**
     * @return int
     */
    public function getMaxRedirects(): int
    {
        return $this->maxRedirects;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}