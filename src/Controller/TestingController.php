<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class TestingController extends AbstractController
{
    #[Route('/', name: 'get_number')]
    public function getNumber(): Response
    {
        $number = random_int(0, 2);
        $paymentStatusName = match ($number) {
            0 => "active",
            1 => "pending",
            2 => "passive",
        };

//        $html = $twig->render('testing/getNumber.html.twig', [
//            'title' => 'Get Number',
//            'paymentStatus' => $paymentStatusName,
//        ]);

        return $this->render('testing/getNumber.html.twig', [
            'title' => 'Get Number',
            'paymentStatus' => $paymentStatusName,
        ]);
    }

    #[Route('/print/{playerUUID}', name: 'print_name')]
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

        dump($fullNames);

        //return new Response($display);
        return $this->render('testing/printName.html.twig', [
            'title' => 'Print Name',
            'username' => $playerUUID,
            'numbers' => $randomArr,
            'fullNames' => $fullNames,
        ]);
    }
}