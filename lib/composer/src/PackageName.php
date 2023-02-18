<?php

namespace InitializerForLaravel\Composer;

/**
 * @see https://getcomposer.org/doc/04-schema.md#name
 */
class PackageName
{
    /**
     * @see https://getcomposer.org/doc/04-schema.md#name
     */
    const VENDOR_REGEX = '^[a-z0-9]([_.-]?[a-z0-9]+)*$';

    /**
     * @see https://getcomposer.org/doc/04-schema.md#name
     */
    const PACKAGE_REGEX = '^[a-z0-9](([_.]?|-{0,2})[a-z0-9]+)*$';

    const HUMAN_READABLE_DESCRIPTION = 'lowercased, aplhanumerical words, separated by -, . or _';
}
