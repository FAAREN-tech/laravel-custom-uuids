<?php

namespace FaarenTech\LaravelCustomUuids\Interfaces;

interface HasCustomUuidInterface
{
    /**
     * Must return the desired prefix for this model
     * E.g. for Vehicle this could be vehic
     *
     * @return string
     */
    public function getUuidPrefix(): string;

    /**
     * Must return the name of the table this model is stored in
     *
     * @return string
     */
    public function getTable();
}
