<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = "Pending";
    case Completed = "Completed";
}
