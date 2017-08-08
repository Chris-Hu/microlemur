<?php declare(strict_types=1);

namespace Core\Session;

/**
 * Standard Session storage based upon PHP Session array
 * @author Chris K. Hu <chris@microlemur.com>
 */

class SessionStorage implements SessionInterface
{
    /**
     * @var bool
     */
    private static $isStarted = false;

    /**
     * @return mixed
     */
    public function start(array $options = [])
    {
        if (!static::$isStarted) {
            if ( session_status() === PHP_SESSION_NONE) {
                session_start($options);
            }
            static::$isStarted = true;
        }
    }

    /**
     * @return bool
     */
    public function isStarted():bool
    {
        return static::$isStarted;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function setId(string $id = null)
    {
        session_id($id);
    }

    /**
     * @return string
     */
    public function getId():string
    {
        return session_id();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name = null)
    {
        session_name($name);
    }

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @return mixed
     */
    public function clear()
    {
        $_SESSION = [];
    }

    /**
     * Destroys current session.
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * @param $key
     * @return bool
     */
    public function exists($key):bool
    {
        return !empty($this->get($key));
    }
}