<?php

namespace App\Component\Employee;

enum EmployeeType: int
{
    case DEVELOPER     = 0;
    case DESIGNER      = 1;
    case DEVOPS        = 2;
    case ADMINISTRATOR = 3;
}
