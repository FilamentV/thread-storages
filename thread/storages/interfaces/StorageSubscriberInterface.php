<?php

namespace thread\storages\interfaces;

/**
 * Interface StorageSubscriberInterface
 *
 * @package thread\storages\interfaces
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
interface StorageSubscriberInterface
{
    /**
     * @param string $event
     * @param array $keys
     * @return mixed
     */
    public function publicize(string $event, array $keys);
}