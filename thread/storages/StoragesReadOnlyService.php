<?php

namespace thread\storages;

use thread\storages\interfaces\StoragesReadOnlyServiceInterface;
use thread\storages\readonly\interfaces\StorageReadOnlyInterface;

/**
 * Class StoragesReadOnlyService
 *
 * @package thread\storages
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StoragesReadOnlyService implements StoragesReadOnlyServiceInterface
{
    /**
     * @var array
     */
    private $storages = [];
    /**
     * @var StorageReadOnlyInterface|null
     */
    private $currency = null;

    /**
     * @param string $key
     * @param StorageReadOnlyInterface $storage
     */
    public function addStorage(string $key, StorageReadOnlyInterface $storage)
    {
        $storage->init();
        $this->storages[$key] = $storage;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function setCurrency(string $key): bool
    {
        $r = false;
        if ($this->hasStorage($key)) {
            $this->currency = $key;
            $r = true;
        }
        return $r;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key, $default = null)
    {
        if (!$this->hasStorage($this->currency)) {
            return $default;
        }
        /**
         * @var $s StorageReadOnlyInterface
         */
        $s = $this->storages[$this->currency];
        return $s->get($key, $default);
    }

    /**
     * @param string $storage
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function getStorageData(string $storage, string $key, $default = null)
    {
        if (!$this->hasStorage($storage)) {
            return $default;
        }
        /**
         * @var $s StorageReadOnlyInterface
         */
        $s = $this->storages[$storage];
        return $s->get($key, $default);
    }

    /**
     * @param null $default
     * @return mixed|null
     */
    public function getAllData($default = null)
    {
        if (!$this->hasStorage($this->currency)) {
            return $default;
        }
        /**
         * @var $storage StorageReadOnlyInterface
         */
        $storage = $this->storages[$this->currency];
        return $storage->getAllData();
    }

    /**
     * @param string $storage
     * @param null $default
     * @return mixed|null
     */
    public function getAllStorageData(string $storage, $default = null)
    {
        if (!$this->hasStorage($storage)) {
            return $default;
        }
        /**
         * @var $s StorageReadOnlyInterface
         */
        $s = $this->storages[$storage];
        return $s->getAllData();
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasStorage(string $key): bool
    {
        return isset($this->storages[$key]);
    }
}