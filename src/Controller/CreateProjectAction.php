<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\CurrentUser;
use App\Controller\Base\AbstractController;
use App\Entity\Project;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateProjectService
 *
 * CreateProjectService
 *
 * @package App\Controller
 */
class CreateProjectAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(Project $data): Project
    {
        $this->validate($data);
        $uniqueEmployees = array_unique($data->getEmployees()->toArray(), SORT_REGULAR);

        foreach ($uniqueEmployees as $employee) {
            $data->addEmployee($employee);
        }

        return $data;
    }
}
