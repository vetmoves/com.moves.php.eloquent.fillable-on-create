<?php

namespace Moves\FillableOnCreate\Traits;

trait FillableOnCreate
{
    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        $fillable = parent::getFillable();
        $fillableOnCreate = $this->getFillableOnCreate();

        if (!$this->exists) {
            $fillable = array_merge($fillable, $fillableOnCreate ?? []);
        }

        return $fillable;
    }

    /**
     * Get fillable attributes for the model when it does not exist.
     *
     * @return array
     */
    public function getFillableOnCreate()
    {
        return $this->fillableOnCreate;
    }

    /**
     * Get the guarded attributes for the model.
     *
     * @return array
     */
    public function getGuarded()
    {
        $guarded = parent::getGuarded();
        $guardedOnCreate = $this->getGuardedOnCreate();

        if (!$this->exists) {
            $guarded = array_merge($guarded, $guardedOnCreate ?? []);
        }

        return $guarded;
    }

    /**
     * Get the guarded attributes for the model when it does not exist.
     *
     * @return array
     */
    public function getGuardedOnCreate()
    {
        return $this->guardedOnCreate;
    }
}
