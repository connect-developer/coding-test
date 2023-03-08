<?php

namespace App\Http\Controllers\Traits;

trait SuccessResponseTrait {
    public function success()
    {
        return response()->noContent();
    }
}