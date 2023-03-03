<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class LogLevel extends Enum
{
    const FATAL = "FATAL";
    const ERROR = "ERROR";
    const WARNING = "WARNING";
    const INFO = "INFO";
    const DEBUG = "DEBUG";
    const TRACE = "TRACE";
}
