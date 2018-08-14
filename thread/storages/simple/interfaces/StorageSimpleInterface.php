<?php

namespace thread\storages\simple\interfaces;
/**
 * Interface StorageSimple
 *
 * @package thread\storages\simple\interfaces
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
interface StorageSimpleInterface
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value): bool;

    /**
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool;

    /**
     * @return bool
     */
    public function clear(): bool;

    /**
     * @param array $keys
     * @param null $default
     * @return array
     */
    public function getMultiple(array $keys, $default = null): array;

    /**
     * @param array $values
     * @return bool
     */
    public function setMultiple(array $values): bool;

    /**
     * @param $keys
     * @return bool
     */
    public function deleteMultiple(array $keys): bool;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @return mixed
     */
    public function init();
}