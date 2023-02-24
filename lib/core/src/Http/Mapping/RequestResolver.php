<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use BackedEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ReflectionNamedType;
use ReflectionParameter;

readonly final class RequestResolver
{
    public function __construct(private Request $request)
    {
    }

    public function valueFor(
        ReflectionParameter $parameter,
        ReflectionNamedType $type
    ): mixed {
        $attribute = $this->findAttribute($parameter);
        $name = $attribute->name ?? Str::kebab($parameter->name);

        $requestValue = $this->request->get($name);


        // Returning null when nothing was sent, but the parameter won't accept
        // it most likely leads to errors. In this case we'll just supply the
        // parameters' default value.
        if ($requestValue === null && $parameter->allowsNull() && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        // Enums are a bit special, so we'll handle them separately
        if (enum_exists($type->getName())) {
            /** @var class-string<BackedEnum> $enum */
            $enum = $type->getName();

            if ($requestValue === null && $parameter->allowsNull()) {
                return null;
            }

            return $enum::from($requestValue);
        }

        return $requestValue;
    }

    private function findAttribute(ReflectionParameter $parameter): Choice&Option
    {
        foreach ($parameter->getAttributes() as $attribute) {
            if (in_array($attribute->getName(), [Option::class, Choice::class])) {
                return $attribute->newInstance();
            }

            throw new MissingMappingAnnotationException($parameter);
        }
    }
}
