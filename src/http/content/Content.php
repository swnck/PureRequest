<?php

namespace Swnck\PureRequest\http\content;

use Swnck\PureRequest\http\frame\Frame;

interface Content
{
    public static function paste($array): Frame;
    public static function empty(): Frame;
}