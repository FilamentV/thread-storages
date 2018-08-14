<?php

namespace thread\storages;
/**
 *
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageSubscriber implements \Serializable
{
    private $closure;
    private $_serialise;
    private $_md5;

    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
        $this->_serialise = $this->serialize();
        $this->_md5 = md5($this->_serialise);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_md5;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->serialize();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->closure);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->closure;
    }

    /**
     *
     */
    public function run()
    {
        $c = $this->closure;
        $c();
    }
}