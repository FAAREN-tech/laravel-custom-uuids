<?php

namespace FaarenTech\LaravelCustomUuids\Helpers;

use FaarenTech\LaravelCustomUuids\Exceptions\UuidException;
use FaarenTech\LaravelCustomUuids\Interfaces\HasCustomUuidInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UuidHelper
{
    /**
     * Max tries to generate a uuid
     */
    const MAX_TRIES = 25;

    /**
     * The length of the total uuid
     */
    const LENGTH_OF_UUID = 32;

    /**
     * Generates a uuid for this instance
     *
     * @return string
     * @throws UuidException
     */
    public static function getUuidForModel(HasCustomUuidInterface $model): string
    {
        if (Str::length($model->getUuidPrefix()) === 0) {
            throw new UuidException("No uuidPrefix was set on model " . get_class($model));
        }

        $unique = false;
        $round = 0;

        while (!$unique) {
            if ($round > self::MAX_TRIES) {
                throw new UuidException("Could not create Uuid for model: " . get_class($model));
            }
            $firstPart = $model->getUuidPrefix() . "_";
            $uuid = $firstPart . Str::random(self::LENGTH_OF_UUID - strlen($firstPart));

            if (self::hasNoEntryInDatabase($model->getTable(), $uuid)) {
                $unique = true;
            }
            $round++;
        }

        return $uuid;
    }

    /**
     * Checks if the given Uuid is unique in the given table
     *
     * @param string $table
     * @param string $uuid
     * @param string $column
     * @return bool
     */
    protected static function hasNoEntryInDatabase(string $table, string $uuid, string $column = "uuid"): bool
    {
        return (DB::table($table)->where('uuid', $uuid)->count() === 0);
    }
}
