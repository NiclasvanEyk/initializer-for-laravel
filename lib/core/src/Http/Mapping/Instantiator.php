<?php

namespace InitializerForLaravel\Core\Http\Mapping;

use Exception;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use SplObjectStorage;

/**
 * @template T
 */
readonly class Instantiator
{
    /**
     * @param SplObjectStorage<ReflectionParameter,mixed> $storage,
     */
    private function __construct(
        private RequestResolver $request,
        private SplObjectStorage $dependants = new SplObjectStorage(),
    ) {
    }

    /**
     * @template X
     * @param class-string<X> $root
     * @return Instantiator<X>
     */
    public static function build(string $root, RequestResolver $request)
    {
        $instance = new self($request);
        $instance->resolveDependencies($root);

        return $instance->instantiate($root);
    }

    private function resolveDependencies(
        ReflectionClass|ReflectionNamedType $subject,
    ): void {
        if ($subject instanceof ReflectionNamedType) {
            $subject = new ReflectionClass($subject);
        }

        $parameters = $subject->getConstructor()->getParameters();
        foreach ($parameters as $parameter) {
            $type = $this->typeOf($parameter);
            if (!$type->isBuiltin()) {
                $this->resolveDependencies($type);
                return;
            }

            $value = $this->request->valueFor($parameter, $type);
            $this->dependants->attach($parameter, $value);
        }
    }

    /**
     * @template X
     * @param class-string<X> $class
     * @return X
     */
    private function instantiate(string $class): mixed
    {
        $reflection = new ReflectionClass($class);
        $parameters = array_map(
            $this->getValueFor(...),
            $reflection->getConstructor()->getParameters()
        );

        return $reflection->newInstance($parameters);
    }

    private function getValueFor(ReflectionParameter $parameter): mixed
    {
        $type = $this->typeOf($parameter);

        if (!$type->isBuiltin()) {
            return $this->instantiate($type->getName());
        }

        return $this->dependants[$parameter];
    }


    private function typeOf(ReflectionParameter $parameter): ReflectionNamedType
    {
        $type = $parameter->getType();
        if (!($type instanceof ReflectionNamedType)) {
            throw new Exception('Mapped types must be named types!');
        }

        return $type;
    }
}
