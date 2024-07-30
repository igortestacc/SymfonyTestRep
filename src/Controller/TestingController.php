<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class TestingController extends AbstractController
{
    #[Route('/')]
    public function getNumber(): Response
    {
        $number = random_int(0, 2);
        $paymentStatusName = match ($number) {
            0 => "active",
            1 => "pending",
            2 => "passive",
        };

        return new Response(
            '<h2>Lucky status: ' . $paymentStatusName . '</h2>'
        );
    }

    #[Route('/print/{playerUUID}')]
    public function printName(string $playerUUID = null) : Response 
    {
        $display = '<h2>Player UUID: ' . $playerUUID . '</h2>';

        $randomArr = [];
        for ($i = 0; $i < 12; $i++) {
            $randomArr[] = random_int(-100, 100);
        }

        $fullNames = [
          ['name' => 'Igor', 'lastName' => 'Maiboroda'],
          ['name' => 'Vlad', 'lastName' => 'Somov'],
          ['name' => 'Ihor', 'lastName' => 'Pryschepa'],
        ];

        //return new Response($display);
        return $this->render('testing/printName.html.twig', [
            'title' => 'Page Name',
            'username' => $playerUUID,
            'numbers' => $randomArr,
            'fullNames' => $fullNames,
        ]);
    }
}