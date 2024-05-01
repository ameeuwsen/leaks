<?php
// src/Controller/OnlyfansController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ThreeController extends AbstractController
{


    public function getDumps($tag) {
        $dumps = \Spyc::YAMLLoad('360.yaml');
        foreach($dumps as $key => $dump) {
            if(!is_null($tag) && !in_array($tag, $dump['tags'])) {
                unset($dumps[$key]);
            }
        }
        return $dumps;
    }

    public function getDetails($model) {
        $details = \Spyc::YAMLLoad('360.yaml')[$model];
        $details['model'] = $model;
        $details['images'] = glob('dumps/360/'.$details['path'].'/*.jpg', GLOB_BRACE);

        return $details;
    }

    #[Route('/360')]
    public function list(): Response {
        return $this->render('360/list.html.twig', [
            'dumps' => $this->getDumps($tag = NULL),
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/360/{model}')]
    public function detail($model): Response {
        return $this->render('360/detail.html.twig', [
            'details' =>  $this->getDetails($model),
        ]);
    }
}