<?php

namespace App\Http\Controllers\Traits;

trait FailedResponseTrait {
    public function failed()
    {
        return response()->json([], 404);
    }
}