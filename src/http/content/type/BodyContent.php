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

namespace Swnck\PureRequest\http\content\type;

use Swnck\PureRequest\http\content\Content;
use Swnck\PureRequest\http\frame\type\BodyFrame;

class BodyContent implements Content
{
    #[\Override] public static function paste($array): BodyFrame
    {
        $finalBody = [];
        foreach ($array as $key => $value) $finalBody[$key] = $value;
        return new BodyFrame($finalBody);
    }

    #[\Override] public static function empty(): BodyFrame
    {

        return new BodyFrame([]);
    }
}