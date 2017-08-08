<?php declare(strict_types=1);

namespace Core\Session;

/**
 * Session Runner
 * @author Chris K. Hu <chris@microlemur.com>
 */

class Session
{
    /**
     * @var SessionInterface
     */
    private $storage;

    /**
     * Session constructor.
     * @param SessionInterface $storage
     */
    public function __construct(SessionInterface $storage = null)
    {
        $this->storage = $storage ?? new SessionStorage();
    }

    public function start()
    {
        $this->storage->start();
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->storage->getId();
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->storage->setId($id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->storage->setName($name);
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function set(string $key, $value)
    {
        $this->storage->set($key,$value);
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->storage->get($key);
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->storage->clear();
        return $this;
    }

    /**
     * @return $this
     */
    public function destroy()
    {
        $this->storage->destroy();
        return $this;
    }
}