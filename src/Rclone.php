<?php

/**
 * This is simple wrapper for rclone command
 *
 * "Matryosha" this is joke, it's alias for wrappers,
 * because rclone also wrapper above rsync, sftp, ceph, etc.
 *
 * @category data transfer
 * @link https://github.com/bezk/matryoshkarsync for issues and pull requests
 * @author Anatoly Bereznyak
 * @copyright 2017
 */

namespace Matryoshka;

use pastuhov\Command\Command;

/**
 * @method string copy()
 * @method string move()
 * @method string sync()
 * @method string check()
 * @method string copyto()
 * @method string moveto()
 * @method string cryptcheck()
 * @method string delete()
 * @method string purge()
 * @method string mkdir()
 * @method string rmdir()
 * @method string rmdirs()
 * @method string ls()
 * @method string lsd()
 * @method string lsl()
 * @method string lsjson()
 * @method string md5sum()
 * @method string sha1sum()
 * @method string size()
 * @method string cleanup()
 * @method string dedupe()
 * @method string cat()
 * @method string authorize()
 * @method string version()
 * @method string listremotes()
 */

/**
 * Class Rclone
 * @package Matryoshka
 */
class Rclone {
    /** @var string $sBinPath */
    protected $sBinPath = 'rclone';

    /** @var strin $sResult */
    protected $sResult;

    /** @var Source $oSource */
    protected $oSource;

    /** @var Destination $oDestination */
    protected $oDestination;

    /** @var Flags $oFlags */
    protected $oFlags;

    /** @var string $sCommand */
    protected $sCommand;

    /**
     * Magic method for typical commands
     * This method returns prepared command string
     *
     * @param $sMethodName
     * @param $aArguments
     * @return $this
     * @throws RcloneException
     */
    public function __call($sMethodName, $aArguments)
    {
        switch ($sMethodName) {
            case 'copy':
            case 'move':
            case 'sync':
            case 'check':
            case 'copyto':
            case 'moveto':
            case 'cryptcheck':
                $this->sCommand = Command::bindParams(
                    '{bin} {command} {source} {destination} {flags}',
                    array_merge(
                        $this->fetchSourceDestinationArgs(),
                        [
                            'command' => $sMethodName
                        ]
                    )
                );
                break;
            case 'delete':
            case 'purge':
            case 'mkdir':
            case 'rmdir':
            case 'rmdirs':
            case 'ls':
            case 'lsd':
            case 'lsl':
            case 'lsjson':
            case 'md5sum':
            case 'sha1sum':
            case 'size':
            case 'cleanup':
            case 'dedupe':
            case 'cat':
                $this->sCommand = Command::bindParams(
                    '{bin} {command} {source} {flags}',
                    array_merge(
                        $this->fetchSourceDestinationArgs(),
                        [
                            'command' => $sMethodName
                        ]
                    )
                );
                break;
            case 'authorize':
            case 'version':
            case 'listremotes':
                $this->sCommand = Command::bindParams(
                    '{bin} {command} {flags}',
                    array_merge(
                        $this->fetchSourceDestinationArgs(),
                        [
                            'command' => $sMethodName
                        ]
                    )
                );
                break;
            default:
                throw new RcloneException('Unsupported methods');
        }

        return $this;
    }

    public function setBin(string $sBinPath)
    {
        $this->sBinPath = $sBinPath;
        return $this;
    }

    public function setSource(Source $oSource)
    {
        $this->oSource = $oSource;
        return $this;
    }

    public function setDestination(Destination $oDestination)
    {
        $this->oDestination = $oDestination;
        return $this;
    }

    public function setOptions(Flags $oFlags)
    {
        $this->oFlags = $oFlags;
    }

    /**
     * Return arguments for actions with source and destination,
     * like copy, move, sync, etc.
     *
     * @return array
     */
    public function fetchSourceDestinationArgs()
    {
        return [
            'bin' => $this->sBinPath,
            'options' => $this->oFlags->fetch(),
            'source' => $this->oSource->fetch(),
            'destination' => $this->oDestination->fetch(),
        ];
    }

    /**
     * Return arguments for actions only with source,
     * like ls, lsd, lsl
     *
     * @return array
     */
    public function fetchSourceArgs()
    {
        return [
            'bin' => $this->sBinPath,
            'options' => $this->oFlags->fetch(),
            'source' => $this->oSource->fetch()
        ];
    }

    public function getCommand()
    {
        return $this->sCommand;
    }

    /**
     * Run command
     * @return bool|string
     */
    public function run()
    {
        return Command::exec($this->sCommand);
    }

    public function getResult()
    {
        return $this->sResult;
    }
}