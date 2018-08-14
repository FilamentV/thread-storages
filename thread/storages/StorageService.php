<?php

namespace thread\storages;

use thread\storages\interfaces\StorageSubscriberInterface;
use thread\storages\simple\interfaces\StorageSimpleInterface;

/**
 * Class StorageService
 *
 * @package thread\storages
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageService
{
    /**
     * @var StorageSimpleInterface
     */
    private $storage;
    private $subscribers = [];

    const EVENTS = [
        'set' => 'set', 'delete' => 'delete'
    ];

    /**
     * StorageService constructor.
     * @param StorageSimpleInterface $storage
     */
    public function __construct(StorageSimpleInterface $storage)
    {
        $storage->init();
        $this->storage = $storage;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->storage->get($key, $default);
    }

    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value): bool
    {
        $r = $this->storage->set($key, $value);
        if ($r == true) {
            $this->invoke(self::EVENTS['set'], [$key]);
        }
        return $r;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        $r = $this->storage->delete($key);
        if ($r == true) {
            $this->invoke(self::EVENTS['set'], [$key]);
        }
        return $r;
    }

    /**
     * @param StorageSubscriberInterface $subscriber
     * @return bool
     */
    public function addSubscriber(StorageSubscriberInterface $subscriber): bool
    {
        $r = false;
        if (!$this->hasSubscriber($subscriber)) {
            $this->subscribers[] = $subscriber;
            $r = true;
        }

        return $r;
    }

    /**
     * @param StorageSubscriberInterface $subscriber
     * @return bool
     */
    public function remSubscriber(StorageSubscriberInterface $subscriber): bool
    {
        $r = false;
        foreach ($this->subscribers as $k => $item) {
            if ($subscriber == $item) {
                unset($this->subscribers[$k]);
                $r = true;
                break;
            }
        }

        return $r;
    }

    /**
     * @param StorageSubscriberInterface $subscriber
     * @return bool
     */
    public function hasSubscriber(StorageSubscriberInterface $subscriber): bool
    {
        $r = false;
        foreach ($this->subscribers as $item) {
            if ($subscriber == $item) {
                $r = true;
                break;
            }
        }

        return $r;
    }

    /**
     * @return \Generator
     */
    protected function getSubscribers()
    {
        foreach ($this->subscribers as $subscriber) {
            yield $subscriber;
        }
    }

    /**
     * @param string $event
     * @param array $keys
     */
    protected function invoke(string $event, array $keys)
    {
        $generator = $this->getSubscribers();
        /**
         * @var $subscriber StorageSubscriberInterface
         */
        foreach ($generator as $subscriber) {
            $subscriber->publicize($event, $keys);
        }
    }
}