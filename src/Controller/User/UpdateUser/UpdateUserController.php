<?php

namespace App\Controller\User\UpdateUser;

use App\Repository\UserRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateUserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user/update/{id}", methods={"POST"})
     */
    public function __invoke(int $id, Request $request): View
    {
        $user = $this->userRepository->find($id);
        if ($user === null) {
            return View::create(null,Response::HTTP_NOT_FOUND);
        }

        $fields = json_decode($request->getContent(),true);

        if (array_key_exists('login', $fields)) {
            $user->setLogin($fields['login']);
        }

        if (array_key_exists('password', $fields)) {
            $user->setPassword($fields['password']);
        }

        if (array_key_exists('role', $fields)) {
            $user->setRole($fields['role']);
        }

        if (array_key_exists('name', $fields)) {
            $user->setName($fields['name']);
        }

        $this->userRepository->save($user);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}
