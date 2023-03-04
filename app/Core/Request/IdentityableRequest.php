<?php

namespace App\Core\Request;

class IdentityableRequest extends AuditableRequest
{
    public int|string $id;
}
