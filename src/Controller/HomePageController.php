<?php
// src/Controller/OnlyfansController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\OnlyfansController;

class HomePageController extends AbstractController
{
    #[Route('/')]
    public function home(): Response {
        $onlyfansController = new OnlyfansController();
        $dumps = $onlyfansController->getDumps(NULL);
        return $this->render('home.html.twig', [
            'onlyfans' => [
                array_key_first($dumps) => array_shift($dumps),
                array_key_first($dumps) => array_shift($dumps),
                array_key_first($dumps) => array_shift($dumps),
            ]
        ]);
    }
}