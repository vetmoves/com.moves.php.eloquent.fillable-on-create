<?php

namespace Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Moves\FillableOnCreate\Traits\FillableOnCreate;

class FillableOnCreateModel extends Model
{
    use FillableOnCreate;

    protected static function boot()
    {
        parent::boot();

        static::$guardableColumns[static::class] = [
            'a', 'b', 'c', 'd', 'e', 'f'
        ];
    }

    public $fillable = [];
    public $fillableOnCreate;

    public $guarded = [];
    public $guardedOnCreate;

    public $exists = false;
}
