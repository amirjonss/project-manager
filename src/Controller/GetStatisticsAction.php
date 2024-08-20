<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\Project\Dto\GetStatisticsDto;
use App\Component\User\CurrentUser;
use App\Controller\Base\AbstractController;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetStatisticsAction
 *
 * GetStatisticsAction
 *
 * @package App\Controller
 */
class GetStatisticsAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private ProjectRepository $projectRepository,
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(Project $project)
    {
        return new GetStatisticsDto(
            $this->projectRepository->getProjectCountEmployees($project),
            $this->projectRepository->getAvgAgeProjectEmployees($project));
    }
}
