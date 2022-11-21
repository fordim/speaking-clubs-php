<?php

namespace App\Controller\User\LogInUser;

use App\Controller\User\UserResponse;
use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogInUserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user/login", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $data = json_decode($request->getContent(),true);

        $login = $data['login'];
        $password = $data['password'];

        //TODO validation to service
        $user = $this->userRepository->findOneBy(['login' => $login]);
        if ($user === null) {
            return View::create('User not found',Response::HTTP_NOT_FOUND);
        }

        if ($user->getPassword() !== $password) {
            return View::create('Wrong password',Response::HTTP_BAD_REQUEST);
        }

        return View::create(UserResponse::createUserResponse($user));
    }
}
