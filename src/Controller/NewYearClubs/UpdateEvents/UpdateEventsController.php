<?php

namespace App\Controller\NewYearClubs\UpdateEvents;

use App\Controller\NewYearClubs\NewYearClubsResponse;
use App\Repository\NewYearClubsRepository;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateEventsController extends AbstractController
{
    private NewYearClubsRepository $newYearClubsRepository;

    public function __construct(NewYearClubsRepository $newYearClubsRepository)
    {
        $this->newYearClubsRepository = $newYearClubsRepository;
    }

    /**
     * @Route("/api/new-year-clubs/update", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $data = json_decode($request->getContent(),true);

        $email = $data['email'];
        $events = $data['events'];

        $newYearClubs = $this->newYearClubsRepository->findOneBy(['email' => $email]);

        if ($newYearClubs === null) {
            return View::create(null,Response::HTTP_NOT_FOUND);
        }

        $newYearClubs->setEvents($events);
        $newYearClubs->setUpdatedAt(new \DateTimeImmutable());
        $this->newYearClubsRepository->save($newYearClubs);

        return View::create(NewYearClubsResponse::createNewYearClubsResponse($newYearClubs));
    }
}
