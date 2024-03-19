<?php

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
        $statusCode = StatusCode::tryFrom($code) ?? StatusCode::DEFAULT;

        try {
            if (curl_errno($ch)) throw new \Exception(curl_error($ch)); //Logical error
        } catch (\Exception $ignore) {
            var_dump($ignore->getMessage());
        }

        curl_close($ch);
        return new ModelInformation($statusCode, $response);
    }
}