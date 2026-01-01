<?php
namespace App\Domains\Actions\DTO;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;

abstract class ActionParameters implements CastsAttributes
{
    protected Collection $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = collect($parameters);
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return new static(json_decode($value, true, 512, JSON_THROW_ON_ERROR));
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return [
            $key => json_encode($this->toArray(), JSON_THROW_ON_ERROR),
        ];
    }

    public function toArray(): array
    {
        return $this->parameters->toArray();
    }
    //
    //    public function offsetExists(mixed $offset) : bool
    //    {
    //        return $this->parameters->offsetExists($offset);
    //    }
    //
    //    public function offsetGet(mixed $offset)
    //    {
    //        return $this->parameters->get($offset);
    //    }
    //
    //    public function offsetSet(mixed $offset, mixed $value) : void
    //    {
    //        $this->parameters->offsetSet($offset, $value);
    //    }
    //
    //    public function offsetUnset(mixed $offset) : void
    //    {
    //        $this->parameters->offsetUnset($offset);
    //    }
}
