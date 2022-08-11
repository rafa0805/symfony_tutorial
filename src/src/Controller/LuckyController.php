<?php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number/{max<\d+>?100}', name: 'app_lucky_number')]
    public function number(int $max, LoggerInterface $logger): Response
    {
        $number = random_int(0, $max);
        $nextLink = $this->generateUrl('app_lucky_number', ['max' => $max]);
        $logger->info("random number was $number");

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
            'next_link' => $nextLink,
        ]);
    }
}
