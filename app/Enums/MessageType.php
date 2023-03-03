<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MessageType extends Enum
{
    const SUCCESS = "SUCCESS";
    const INFO = "INFO";
    const WARNING = "WARNING";
    const ERROR = "ERROR";
}
