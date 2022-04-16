<?php
namespace App\Domains\Payu\Elements;

use ReflectionClass;
use ReflectionProperty;

abstract class BaseElement
{
    public function toArray() : array
    {
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PUBLIC);

        $array = [];
        foreach ($props as $prop) {
            $array[$prop->getName()] = $this->itemToValue($prop->getValue($this));
        }

        return array_filter($array);
    }

    protected function itemToValue(mixed $item) : mixed
    {
        if ($item instanceof BaseElement) {
            return $item->toArray();
        }

        if (is_array($item)) {
            return array_filter(array_map(function ($subItem) {
                return $this->itemToValue($subItem);
            }, $item));
        }

        return $item;
    }
}
