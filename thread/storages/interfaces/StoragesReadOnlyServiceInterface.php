<?php

namespace thread\storages\interfaces;

use thread\storages\readonly\interfaces\StorageReadOnlyInterface;

/**
 * Interface StoragesReadOnlyServiceInterface
 *
 * @package thread\storages\interfaces
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
interface StoragesReadOnlyServiceInterface
{
    /**
     * @param string $key
     * @param StorageReadOnlyInterface $storage
     */
    public function addStorage(string $key, StorageReadOnlyInterface $storage);

    /**
     * @param string $key
     * @return bool
     */
    public function setCurrency(string $key): bool;

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function getData(string $key, $default = null);

    /**
     * @param string $storage
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function getStorageData(string $storage, string $key, $default = null);

    /**
     * @param null $default
     * @return mixed
     */
    public function getAllData($default = null);

    /**
     * @param string $storage
     * @param null $default
     * @return mixed
     */
    public function getAllStorageData(string $storage, $default = null);

    /**
     * @param string $key
     * @return bool
     */
    public function hasStorage(string $key): bool;
}