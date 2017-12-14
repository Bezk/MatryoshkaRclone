<?php

namespace Matryoshka\Assigns;

/**
 * rclone dedupe options
 * Trait DedupeFlagsTrait
 * @package Matryoshka\Assigns
 */
trait DedupeFlagsTrait
{
    /**
     * Dedupe mode interactive|skip|first|newest|oldest|rename. (default "interactive")
     *
     * @param string $sMode
     * @return $this
     */
    public function dedupeMode(string $sMode)
    {
        $this->aFlags['--dedupe-mode'] = $sMode;
        return $this;
    }
}