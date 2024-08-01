<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}