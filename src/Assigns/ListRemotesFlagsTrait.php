<?php

namespace Matryoshka\Assigns;

/**
 * rclone listremotes options
 * Trait ListRemotesFlagsTrait
 * @package Matryoshka\Assigns
 */
trait ListRemotesFlagsTrait
{
    /**
     * Show the type as well as names
     *
     * @return $this
     */
    public function long()
    {
        $this->aFlags['--long'] = null;
        return $this;
    }
}