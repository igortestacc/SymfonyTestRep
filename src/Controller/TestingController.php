<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class TestingController
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
            '<html><body><h2>Lucky status: ' . $paymentStatusName . '</h2></body></html>'
        );
    }

    #[Route('/print/{playerUUID}')]
    public function printName(string $playerUUID = null) : Response 
    {
        $display = '<html><body><h2>Player UUID: ' . $playerUUID . '</h2></body></html>';

        return new Response($display);
    }
}