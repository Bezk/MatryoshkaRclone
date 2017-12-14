<?php

namespace Matryoshka\Assigns;

trait CheckFlagsTrait
{
    public function download()
    {
        $this->aFlags['--download'] = null;
        return $this;
    }
}