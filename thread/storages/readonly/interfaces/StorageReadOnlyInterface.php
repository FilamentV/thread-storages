<?php

namespace thread\storages\readonly\interfaces;
/**
 * Interface StorageReadOnlyInterface
 *
 * @package thread\storages\readonly\interfaces
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
interface StorageReadOnlyInterface
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param array $keys
     * @param null $default
     * @return array
     */
    public function getMultiple(array $keys, $default = null): array;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @return mixed
     */
    public function init();

    /**
     * @return mixed
     */
    public function getAllData();

    /**
     * @return mixed
     */
    public function getKeys();
}