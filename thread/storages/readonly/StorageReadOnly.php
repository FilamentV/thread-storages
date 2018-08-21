<?php

namespace thread\storages\readonly;

use thread\storages\readonly\interfaces\StorageReadOnlyInterface;

/**
 * Class StorageReadOnly
 *
 * @package thread\storages\readonly
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageReadOnly implements StorageReadOnlyInterface
{
    private $data = [];

    /**
     * StorageMemory constructor.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->init();
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * @param array $keys
     * @param null $default
     * @return array
     */
    public function getMultiple(array $keys, $default = null): array
    {
        $r = [];
        foreach ($keys as $key) {
            $r[$key] = $this->data[$key] ?? $default;
        }
        return $r;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @return mixed|void
     */
    public function init()
    {

    }

    /**
     * @return array
     */
    public function getAllData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->data);
    }
}