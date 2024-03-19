<?php

namespace Swnck\PureRequest\http\model;

use Swnck\PureRequest\http\frame\type\BodyFrame;
use Swnck\PureRequest\http\frame\type\HeaderFrame;
use Swnck\PureRequest\http\model\information\ModelInformation;

interface Model
{
    public function build(HeaderFrame $headerFrame, BodyFrame $frame, string $url = ""): ModelInformation;
}