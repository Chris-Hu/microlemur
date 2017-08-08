<?php declare(strict_types=1);
namespace Core\Security\Token;
use Core\Session\SessionStorage;
use Core\Storage\IKeyValue;

/**
 * A Simple Token Manager
 * @author Chris K. Hu <chris@microlemur.com>
 */
class TokenManager
{
    const LENGTH = 32;

    /**
     * @var IKeyValue
     */
    protected $storage;

    /**
     * TokenManager constructor.
     */
    public function __construct(IKeyValue $storage = null)
    {
        $this->storage = $storage ?? new SessionStorage();
    }

    /**
     * @param string $type
     * @param string $id
     * @param int $length
     * @return Token
     */
    public function generate($type = "", $id = "", $length = self::LENGTH) : Token
    {
        $value = rtrim(strtr(base64_encode(random_bytes($length)), '/+', '_-'), '=');
        return new Token($id, $value);
    }

    /**
     * @param Token $token
     * @return bool
     */
    public function isValid(Token $token):bool
    {
        //@todo add implementation
        return true;
    }

    /**
     * @param string $data
     * @return Token
     */
    public function buildFromString(string $data): Token
    {
       if( preg_match($data, '@(?<id>\w+):(?<val>\w+)@' ,$m)) {
           return new Token($m['id'] , $m['val']);
       }

       return false;
    }
}