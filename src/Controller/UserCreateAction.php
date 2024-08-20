<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\CurrentUser;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Controller\Base\AbstractController;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateUserController
 *
 * @package App\Controller
 */
class UserCreateAction extends AbstractController
{
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        CurrentUser $currentUser,
        private UserRepository $userRepository,
    ) {
        parent::__construct($serializer, $validator, $currentUser);
    }

    public function __invoke(User $data, UserFactory $userFactory, UserManager $userManager): User
    {
        $this->validate($data);

        if ($this->isAlreadyHaveEmail($data->getEmail())) {
            throw new HttpException(Response::HTTP_UNPROCESSABLE_ENTITY, 'This email is already used');
        }

        $user = $userFactory->create($data->getEmail(), $data->getPassword());
        $userManager->save($user, true);

        return $user;
    }

    private function isAlreadyHaveEmail(string $email): bool
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        return $user !== null;
    }
}
