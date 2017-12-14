<?php

namespace Matryoshka\Assigns;

/**
 * rclone cat options
 * Trait CatFlagsTrait
 * @package Matryoshka\Assigns
 */
trait CatFlagsTrait
{
    /**
     * Only print N characters. (default -1)
     *
     * @param int $iNum
     * @return $this
     */
    public function count(int $iNum)
    {
        $this->aFlags['--count'] = $iNum;
        return $this;
    }

    /**
     * Discard the output instead of printing
     *
     * @return $this
     */
    public function discard()
    {
        $this->aFlags['--discard'] = null;
        return $this;
    }

    /**
     * Only print the first N characters
     *
     * @param int $iNum
     * @return $this
     */
    public function head(int $iNum)
    {
        $this->aFlags['--head'] = $iNum;
        return $this;
    }

    /**
     * Start printing at offset N (or from end if -ve)
     *
     * @param int $iNum
     * @return $this
     */
    public function offset(int $iNum)
    {
        $this->aFlags['--offset'] = $iNum;
        return $this;
    }

    /**
     * Only print the last N characters
     *
     * @param int $iNum
     * @return $this
     */
    public function tail(int $iNum)
    {
        $this->aFlags['--tail'] = $iNum;
        return $this;
    }
}