<?php

namespace App\Controller\User\LogInUserWithoutPassword;

use App\Controller\User\UserResponse;
use App\Entity\User;
use App\Enum\RoleType;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogInUserWithoutPasswordController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user/login-without-password", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $data = json_decode($request->getContent(),true);

        $login = $data['login'];

        $user = $this->userRepository->findOneBy(['login' => $login]);

        if ($user === null) {
            $newUser = new User();
            $newUser->setLogin($login);
            $newUser->setPassword(null);
            $newUser->setRole(RoleType::user());
            $newUser->setName('User');
            $newUser->setUpdatedAt(new \DateTimeImmutable());

            $this->userRepository->save($newUser);

            return View::create(UserResponse::createUserResponse($newUser));
        }

        return View::create(UserResponse::createUserResponse($user));
    }
}
