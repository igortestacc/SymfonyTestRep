<?php

namespace App\Controller;

use App\Entity\UserNew;
use App\Repository\UserNewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class DataController extends AbstractController
{
    #[Route('/api/data/{id<\d+>}', name: 'api_data', methods: ['GET'])]
    public function getUserInfo(int $id, LoggerInterface $logger): Response
    {
        $user = [
            'id' => $id,
            'createdAt' => new \DateTime('2023-08-05'),
            'phone' => "+380505055050",
            'country' => "UA",
        ];

        // write message to logs
        $logger->info('Return API response osf {userID} user', [
            'userID' => $id,
        ]);

        //return new JsonResponse($user);
        return $this->json($user);
    }

    #[Route('/api/new', name: 'api_new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $userDB = new UserNew();
        $userDB->setUsername('sombo1');
        $userDB->setAge(18);

        $entityManager->persist($userDB);
        $entityManager->flush();

        return new Response(sprintf('New user with id: %d added!', $userDB->getId()));
    }

    #[Route('/api/getAll/{username}', name: 'api_getAll')]
    public function getAll(UserNewRepository $newRepository, $username)
    {
        //$users_new = $newRepository->findAll();
        //$users_new = $newRepository->findBy(['username' => $username], ['dateBirth' => 'DESC']);
        $users_new = $newRepository->findAllByUsername($username);
        dd($users_new);
    }

    #[Route('/api/show/{id}', name: 'api_show')]
    public function show(UserNewRepository $newRepository, $id)
    {
        $user_new = $newRepository->find($id);

        if (!$user_new) {
            throw $this->createNotFoundException('User new not found');
        }

        dd($user_new);
    }

    #[Route('/api/show_other/{id}/age', name: 'api_show_other', methods: ['POST'])]
    public function show_other(UserNew $userNew, Request $request)
    {
        $direction = $request->get('direction');

        if ($direction == 'up') {
            $userNew->setAge($userNew->getAge() + 1);
        } elseif ($direction == 'down') {
            $userNew->setAge($userNew->getAge() - 1);
        }

        dd($userNew);
    }
}