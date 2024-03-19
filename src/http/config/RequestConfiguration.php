<?php

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