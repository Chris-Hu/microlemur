<?php declare(strict_types=1);

namespace Core\Http;

/**
 * @author Chris K. Hu <chris@microlemur.com>
 */
class Request implements RequestInterface
{
    const METHOD_HEAD = 'HEAD';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PURGE = 'PURGE';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_TRACE = 'TRACE';
    const METHOD_CONNECT = 'CONNECT';

    /**
     * @param string $method
     * @param string $key
     * @param int $filter
     * @param array $options
     * @return bool|mixed
     */
    public function read(string $method ,string $key ,int $filter = FILTER_DEFAULT ,array $options = [])
    {
        $sanitize = function ($value) use ($filter ,$options) {
                return $this->filter($value,$filter ,$options);
        };

        switch ($method){
            case self::METHOD_GET:
                return $sanitize($_GET[$key] ?? false);
            case self::METHOD_POST:
                return $sanitize($_POST[$key] ?? false);
            default:
                return false;
        }
    }

    /**
     * Attempts to detect if the current connection is secure through
     * a few different methods.
     *
     * @return bool
     */
    public function isSecure(): bool
    {
        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
        {
            return true;
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        {
            return true;
        }
        elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
        {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @param int $filter
     * @param array $options
     * @return mixed
     */
    protected function filter($value, $filter = FILTER_DEFAULT, $options = [])
    {
        static $filters = null;

        if (is_bool($value) && $filter == FILTER_DEFAULT) {
            return $value;
        }

        if (null === $filters) {
            foreach (filter_list() as $f) {
                $filters[filter_id($f)] = 1;
            }
        }

        if (is_array($value) && !isset($options['flags'])) {
            $options['flags'] = FILTER_REQUIRE_ARRAY;
        }

        return filter_var($value, $filter, $options);
    }
}