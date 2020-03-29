<?php

namespace Opay\Result;

class OrderResponse
{
    public $code;
    public $message;
    public $data;

    public static function cast(OrderResponse $destination, \stdClass $source) : OrderResponse
    {
        $sourceReflection = new \ReflectionObject($source);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $name = $sourceProperty->getName();
            if ($name === 'data') {
                $destination->{$name} = OrderResponseData::cast(new OrderResponseData(), $source->$name);
            } else {
                $destination->{$name} = $source->$name;
            }
        }
        return $destination;
    }

    public function toArray() : array {
        return (array) $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return OrderResponseData
     */
    public function getData() : OrderResponseData
    {
        return $this->data;
    }

}