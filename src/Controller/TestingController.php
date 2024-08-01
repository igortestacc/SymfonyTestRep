<?php

namespace App\Controller;

use App\Service\TestingService;
use Knp\Bundle\TimeBundle\DateTimeFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestingController extends AbstractController
{
    #[Route('/', name: 'get_number')]
    public function getNumber(TestingService $testingService): Response
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

        $responceCache = $testingService->getAllInfo();

        return $this->render('testing/getNumber.html.twig', [
            'title' => 'Get Number',
            'paymentStatus' => $paymentStatusName,
            'music' => $responceCache,
        ]);
    }

    #[Route('/print/{playerUUID}', name: 'print_name')]
    public function printName(string $playerUUID = null, DateTimeFormatter $timeFormatter) : Response
    {
        $display = '<h2>Player UUID: ' . $playerUUID . '</h2>';

        $randomArr = [];
        for ($i = 0; $i < 12; $i++) {
            $randomArr[] = random_int(-100, 100);
        }

        $fullNames = [
          ['name' => 'Igor', 'lastName' => 'Maiboroda', 'createdAt' => new \DateTime('2022-10-05')],
          ['name' => 'Vlad', 'lastName' => 'Somov', 'createdAt' => new \DateTime('2024-08-06')],
          ['name' => 'Ihor', 'lastName' => 'Pryschepa', 'createdAt' => new \DateTime()],
        ];

        //$fullNames - array of objects, key - int index of objects, name - object
        foreach ($fullNames as $key => $name) {
            //add to all objects in array $fullNames field 'ago'
            $fullNames[$key]['ago'] = $timeFormatter->formatDiff($name['createdAt']);
        }

        //return new Response($display);
        return $this->render('testing/printName.html.twig', [
            'title' => 'Print Name',
            'username' => $playerUUID,
            'numbers' => $randomArr,
            'fullNames' => $fullNames,
        ]);
    }
}