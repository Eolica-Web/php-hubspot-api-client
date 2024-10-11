<?php

declare(strict_types=1);

namespace Eolica\Hubspot;

/**
 * @template TKey
 * @template TValue
 * @template TMapWithKeysKey of array-key
 * @template TMapWithKeysValue
 *
 * @param callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue> $fn
 * @param array<TKey, TValue> $array
 *
 * @return array<TMapWithKeysKey, TMapWithKeysValue>
 */
function array_map_with_keys(callable $fn, array $array): array
{
    $result = [];

    foreach ($array as $key => $value) {
        $assoc = $fn($value, $key);

        foreach ($assoc as $mapKey => $mapValue) {
            $result[$mapKey] = $mapValue;
        }
    }

    return $result;
}
