<?php
namespace LWechat\Message\Type;
use LWechat\Core\Attribute;

abstract class AbstractMessage extends Attribute
{
    /**
     * message id
     * @var int
     */
    protected $id;

    /**
     * Message target user open id
     * @var string
     */
    protected $to;

    /**
     * Message sender user open id
     * @var string
     */
    protected $from;

    /**
     * Message Type
     * @var string
     */
    protected $msgType;
    /**
     * Message attributes.
     * @var array
     */
    protected $properties = [];

    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * Magic getter.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return parent::__get($property);
    }

    /**
     * Magic setter.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return AbstractMessage
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            parent::__set($property, $value);
        }

        return $this;
    }
}