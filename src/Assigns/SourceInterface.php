<?php

namespace Matryoshka\Assigns;

/**
 * Interface SourceInterface
 * @package Matryoshka\Assigns
 * @todo maybe reasonably make named classes like Dropbox, Ceph, etc.
 */
interface SourceInterface
{
    public function setName(string $sName);

    public function setBucket(string $sBucket);

    public function setPath(string $sPath);
}