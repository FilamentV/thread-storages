<?php

namespace thread\storages\simple;

use thread\storages\simple\interfaces\StorageSimpleInterface;

/**
 * Class StorageSimple
 *
 * @package thread\storages\simple
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageSimple implements StorageSimpleInterface
{
    private $data = [];

    /**
     * StorageMemory constructor.
     */
    public function __construct()
    {
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
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value): bool
    {
        $r = true;
        try {
            $this->data[$key] = $value;
        } catch (\Exception $exception) {
            $r = false;
        }
        return $r;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        if ($this->has($key)) {
            unset($this->data[$key]);
        }
        return !$this->has($key);
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        $this->data = [];
        return empty($this->data);
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
     * @param array $values
     * @return bool
     */
    public function setMultiple(array $values): bool
    {
        $r = true;
        try {
            foreach ($values as $key => $value) {
                $this->set($key, $value);
            }
        } catch (\Exception $exception) {
            $r = false;
        }
        return $r;
    }

    /**
     * @param $keys
     * @return bool
     */
    public function deleteMultiple(array $keys): bool
    {
        $r = true;
        try {
            foreach ($keys as $key) {
                $this->delete($key);
            }
        } catch (\Exception $exception) {
            $r = false;
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
    public function getAllData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return array_keys($this->data);
    }
}