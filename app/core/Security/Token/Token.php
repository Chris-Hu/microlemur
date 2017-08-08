<?php declare(strict_types=1);
namespace Core\Security\Token;

/**
 * Token
 * @author Chris K. Hu <chris@microlemur.com>
 */

class Token
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $value;


    /**
     * Token constructor.
     * @param string $id
     * @param string $value
     */
    public function __construct(string $id,  string $value)
    {
        $this->id = $id;
        $this->$value = $value;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->id.":".$this->value;
    }
}