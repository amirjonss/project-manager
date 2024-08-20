<?php

declare(strict_types=1);

namespace App\Component\Project\Dto;

/**
 * Class GetStatisticsDto
 *
 * GetStatisticsDto
 *
 * @package App\Component\Project\Dto
 */
class GetStatisticsDto
{
    public function __construct(
        private int $countEmployees,
        private int $avgAge
    ) {
    }

    public function getCountEmployees(): int
    {
        return $this->countEmployees;
    }

    public function getAvgAge(): int
    {
        return $this->avgAge;
    }
}
