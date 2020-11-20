<?php


namespace Opay\Result;


abstract class Response
{
    public $code;
    public $message;
    public $data;

    /**
     * @param \stdClass|null $s
     * @return mixed
     */
    abstract static function parseData(?\stdClass $s);
    public abstract function getData();

    public static function cast(Response $destination, \stdClass $source) : Response
    {
        $sourceReflection = new \ReflectionObject($source);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $name = $sourceProperty->getName();
            if ($name === 'data') {
                if (is_array($source->$name)) {
                    $arrIn = (array) $source->$name;
                    $arrOut = array();
                    foreach ($arrIn as $value) {
                        $arrOut[] = static::parseData($value);
                    }
                    $destination->{$name} = $arrOut;
                } else {
                    $destination->{$name} = static::parseData($source->$name);
                }
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
}