<?php

namespace Matryoshka\Assigns;

/**
 * Common setting for source and destination
 * Class AbstractSource
 * @package Matryoshka\Assigns
 */
abstract class AbstractSource implements SourceInterface
{
    protected $aData = [];

    /**
     * Is name from rclone config
     * @param string $sName
     * @return $this
     * @required
     */
    public function setName(string $sName)
    {
        $this->aData['name'] = trim($sName, ':');
        return $this;
    }

    /**
     * Bucket name for object storages,
     * also can be used as a prefix for regular storages, like local or sftp
     * for unification
     *
     * @param string $sBucket
     * @return $this
     */
    public function setBucket(string $sBucket)
    {
        $this->aData['bucket'] = rtrim($sBucket, '/');
        return $this;
    }

    /**
     * Path into bucket
     *
     * @param string $sPath
     * @return $this
     */
    public function setPath(string $sPath)
    {
        $this->aData['path'] = $sPath;
        return $this;
    }

    /**
     * Returns param/params
     *
     * @param string $sParam
     * @return array|string
     * @throws RcloneException
     */
    public function get(string $sParam = '')
    {
        if ($sParam && !isset($this->aData[$sParam])) {
            throw new RcloneException('Undefined param: ' . $sParam);
        }

        return $sParam
            ? $this->aData[$sParam]
            : $this->aData;
    }

    /**
     * Fetch string for rsync command
     *
     * @return string
     * @throws RcloneException
     */
    public function fetch()
    {
        if (!isset($this->aData['name'])) {
            throw new RcloneException('Name not defined');
        }

        return $this->aData['name'] . ':' .
            ($this->aData['bucket'] ?? '') .
            ($this->aData['path'] ?? '');
    }
}