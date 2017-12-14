<?php

namespace Matryoshka\Assigns;

/**
 * Class for command flags
 *
 * Class Flags
 * @package Matryoshka\Assigns
 * @todo add more methods ¯\_(ツ)_/¯
 */
class Flags
{
    use CheckFlagsTrait;
    use DedupeFlagsTrait;
    use CatFlagsTrait;
    use ListRemotesFlagsTrait;

    protected $aFlags = [];

    /**
     * Don't update destination mod-time if files identical
     *
     * @return $this
     */
    public function noUpdateModTime()
    {
        $this->aFlags['--no-update-modtime'] = null;
        return $this;
    }

    /**
     * Specify the location of the rclone config file.
     *
     * @param string $sPath
     * @throws RcloneException
     * @return $this
     */
    public function config(string $sPath)
    {
        if (!is_readable(realpath($sPath)))
        {
            throw new RcloneException('Config file not readable');
        }

        $this->aFlags['--config'] = $sPath;

        return $this;
    }

    /**
     * Make backups into hierarchy based in DIR.
     *
     * @param string $sPath
     * @return $this
     * @throws RcloneException
     */
    public function backupDir(string $sPath)
    {
        $this->aFlags['--backup-dir'] = $sPath;
        return $this;
    }

    /**
     * Number of checkers to run in parallel. (default 8)
     *
     * @param int $iNum
     * @return $this
     */
    public function checkers(int $iNum)
    {
        $this->aFlags['--checkers'] = $iNum;
        return $this;
    }

    /**
     * Skip based on checksum & size, not mod-time & size
     *
     * @return $this
     */
    public function checksum()
    {
        $this->aFlags['--checksum'] = null;
        return $this;
    }

    /**
     * Connect timeout (default 1m0s)
     *
     * @param string $sDuration
     * @return $this
     */
    public function contimeout(string $sDuration)
    {
        $this->aFlags['--contimeout'] = $sDuration;
        return $this;
    }

    /**
     * Follow symlinks and copy the pointed to item
     *
     * @return $this
     */
    public function copyLinks()
    {
        $this->aFlags['--copy-links'] = null;
        return $this;
    }

    /**
     * Write cpu profile to file
     *
     * @param string $sPath
     * @return $this
     * @throws RcloneException
     */
    public function cpuProfile(string $sPath)
    {
        if (!is_writable(realpath($sPath)))
        {
            throw new RcloneException("Not writable {$sPath}");
        }

        $this->aFlags['--cpuprofile'] = $sPath;
        return $this;
    }

    /**
     * When synchronizing, delete files on destination after transfering
     *
     * @return $this
     */
    public function deleteAfter()
    {
        $this->aFlags['--delete-after'] = null;
        return $this;
    }

    /**
     * When synchronizing, delete files on destination before transfering
     *
     * @return $this
     */
    public function deleteBefore()
    {
        $this->aFlags['--delete-before'] = null;
        return $this;
    }

    /**
     * When synchronizing, delete files during transfer (default)
     *
     * @return $this
     */
    public function deleteDuring()
    {
        $this->aFlags['--delete-during'] = null;
        return $this;
    }

    /**
     * Exclude files matching pattern
     *
     * @return $this
     */
    public function exclude(string $sPattern)
    {
        $this->aFlags['--exclude'] = $sPattern;
        return $this;
    }

    /**
     * Delete files on dest excluded from sync
     *
     * @return $this
     */
    public function deleteExcluded()
    {
        $this->aFlags['--delete-excluded'] = null;
        return $this;
    }

    /**
     * Do a trial run with no permanent changes
     *
     * @return $this
     */
    public function dryRun()
    {
        $this->aFlags['--dry-run'] = null;
        return $this;
    }

    /**
     * Dump HTTP headers with auth info
     *
     * @return $this
     */
    public function dumpAuth()
    {
        $this->aFlags['--dump-auth'] = null;
        return $this;
    }

    /**
     * Dump HTTP headers and bodies - may contain sensitive info
     *
     * @return $this
     */
    public function dumpBodies()
    {
        $this->aFlags['--dump-bodies'] = null;
        return $this;
    }

    /**
     * Dump the filters to the output
     *
     * @return $this
     */
    public function dumpFilters()
    {
        $this->aFlags['--dump-filters'] = null;
        return $this;
    }

    /**
     * Dump HTTP headers - may contain sensitive info
     *
     * @return $this
     */
    public function dumpHeaders()
    {
        $this->aFlags['--dump-headers'] = null;
        return $this;
    }

    /**
     * Read list of source-file names from file
     *
     * @param string $sFile
     * @return $this
     * @throws RcloneException
     */
    public function filesFrom(string $sFile)
    {
        if (!is_readable(realpath($sFile)))
        {
            throw new RcloneException("Not readable {$sFile}");
        }

        $this->aFlags['--files-from'] = $sFile;
        return $this;
    }

    /**
     * Add a file-filtering rule
     *
     * @param string $sFilter
     * @return $this
     */
    public function filter(string $sFilter)
    {
        $this->aFlags['--filter'] = $sFilter;
        return $this;
    }

    /**
     * Skip post copy check of checksums
     *
     * @return $this
     */
    public function ignoreChecksum()
    {
        $this->aFlags['--ignore-checksum'] = null;
        return $this;
    }

    /**
     * Skip all files that exist on destination
     *
     * @return $this
     */
    public function ignoreExisting()
    {
        $this->aFlags['--ignore-existing'] = null;
        return $this;
    }

    /**
     * Ignore size when skipping use mod-time or checksum.
     *
     * @return $this
     */
    public function ignoreSize()
    {
        $this->aFlags['--ignore-size'] = null;
        return $this;
    }

    /**
     * Don't skip files that match size and time - transfer
     *
     * @return $this
     */
    public function ignoreTimes()
    {
        $this->aFlags['--ignore-times'] = null;
        return $this;
    }

    /**
     * Do not modify files. Fail if existing files have been modified.
     *
     * @return $this
     */
    public function immutable()
    {
        $this->aFlags['--immutable'] = null;
        return $this;
    }

    /**
     * Log everything to this file
     *
     * @param string $sPath
     * @return $this
     */
    public function logFile(string $sPath)
    {
        $this->aFlags['--log-file'] = $sPath;
        return $this;
    }

    /**
     * Log level DEBUG|INFO|NOTICE|ERROR (default "NOTICE")
     *
     * @param string $sLogLevel
     * @return $this
     */
    public function logLevel(string $sLogLevel)
    {
        $this->aFlags['--log-level'] = $sLogLevel;
        return $this;
    }

    /**
     * Do not verify the server SSL certificate. Insecure.
     *
     * @return $this
     */
    public function noCheckCertificate()
    {
        $this->aFlags['--no-check-certificate'] = null;
        return $this;
    }

    /**
     * Don't traverse destination file system on copy
     *
     * @return $this
     */
    public function noTraverse()
    {
        $this->aFlags['--no-traverse '] = null;
        return $this;
    }

    /**
     * Don't cross filesystem boundaries.
     *
     * @return $this
     */
    public function oneFileSystem()
    {
        $this->aFlags['--one-file-system'] = null;
        return $this;
    }

    /**
     * Print as little stuff as possible
     *
     * @return $this
     */
    public function quiet()
    {
        $this->aFlags['--quiet'] = null;
        return $this;
    }

    /**
     * Retry operations this many times if they fail (default 3)
     *
     * @param int $iRetries
     * @return $this
     */
    public function retries(int $iRetries)
    {
        $this->aFlags['--retries'] = $iRetries;
        return $this;
    }

    /**
     * Canned ACL used when creating buckets and/or storing objects in S3
     *
     * @param string $sAcl
     * @return $this
     */
    public function s3Acl(string $sAcl)
    {
        $this->aFlags['--s3-acl'] = $sAcl;
        return $this;
    }

    /**
     * Storage class to use when uploading S3 objects (STANDARD|REDUCED_REDUNDANCY|STANDARD_IA)
     *
     * @param string $sClass
     * @return $this
     */
    public function s3StorageClass(string $sClass)
    {
        $this->aFlags['--s3-storage-class'] = $sClass;
        return $this;
    }

    /**
     * Skip based on size only, not mod-time or checksum
     *
     * @return $this
     */
    public function sizeOnly()
    {
        $this->aFlags['--size-only'] = null;
        return $this;
    }

    /**
     * Don't warn about skipped symlinks
     *
     * @return $this
     */
    public function skipLinks()
    {
        $this->aFlags['--skip-links'] = null;
        return $this;
    }

    /**
     * Suffix for use with --backup-dir
     *
     * @param string $sSuffix
     * @return $this
     */
    public function suffix(string $sSuffix)
    {
        $this->aFlags['--suffix'] = $sSuffix;
        return $this;
    }

    /**
     * Above this size files will be chunked into a _segments container. (default 5G)
     *
     * @param string $sChunkSize
     * @return $this
     */
    public function swiftChunkSize(string $sChunkSize)
    {
        $this->aFlags['--swift-chunk-size'] = $sChunkSize;
        return $this;
    }

    /**
     * IO idle timeout (default 5m0s)
     *
     * @param string $sTimeout
     * @return $this
     */
    public function timeout(string $sTimeout)
    {
        $this->aFlags['--timeout'] = $sTimeout;
        return $this;
    }

    /**
     * Limit HTTP transactions per second to this
     *
     * @param float $fLimit
     * @return $this
     */
    public function tpsLimit(float $fLimit)
    {
        $this->aFlags['--tpslimit'] = $fLimit;
        return $this;
    }

    /**
     * Max burst of transactions for --tpslimit. (default 1)
     *
     * @param int $iLimit
     * @return $this
     */
    public function tpsLimitBurst(int $iLimit)
    {
        $this->aFlags['--tpslimit'] = $iLimit;
        return $this;
    }

    /**
     * When synchronizing, track file renames and do a server side move if possible
     *
     * @return $this
     */
    public function trackRenames()
    {
        $this->aFlags['--track-renames'] = null;
        return $this;
    }

    /**
     * Number of file transfers to run in parallel. (default 4)
     *
     * @param int $iNum
     * @return $this
     */
    public function transfers(int $iNum)
    {
        $this->aFlags['--transfers'] = $iNum;
        return $this;
    }

    /**
     * Skip files that are newer on the destination
     *
     * @return $this
     */
    public function update()
    {
        $this->aFlags['--update'] = null;
        return $this;
    }

    /**
     * Set the user-agent to a specified string. The default is rclone/ version (default "rclone/v1.38")
     *
     * @param string $sUserAgent
     * @return $this
     */
    public function userAgent(string $sUserAgent)
    {
        $this->aFlags['--user-agent'] = $sUserAgent;
        return $this;
    }

    /**
     * Returns prepared flags string
     *
     * @return string
     */
    public function fetch()
    {
        $aFlags = [];

        foreach ($this->aFlags as $sOption => $sValue) {
            $aFlags[] = $sOption . ($sValue ? ' ' . $sValue : '');
        }

        return implode(' ', $aFlags);
    }

    public function get(string $sFlag = '')
    {
        return $sFlag
            ? $this->aFlags[$sFlag] ?? ''
            : $this->aData;
    }
}
