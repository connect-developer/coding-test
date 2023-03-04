<?php

namespace App\Core\Entity;

use Illuminate\Database\Eloquent\SoftDeletes;

class BaseSoftDeleteEntity extends BaseEntity
{
    use SoftDeletes;

    protected $dates = [ 'deleted_at' ];
}
