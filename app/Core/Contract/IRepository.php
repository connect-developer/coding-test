<?php

namespace App\Core\Contract;

use App\Core\Entity\BaseEntity;
use Illuminate\Support\Collection;

interface IRepository
{
    public function all(string $order = "id", string $sort = "asc"): Collection;

    public function findById(int|string $id): BaseEntity|null;
}
