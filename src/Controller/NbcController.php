<?php
// src/Controller/OnlyfansController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class NbcController extends AbstractController
{


    public function getDumps($model) {
//        $map = \Spyc::YAMLLoad('nbc.yaml')['galleries'];
//        $dumps = [];
//        foreach($map as $key => $dump) {
//            $dumps[$key] = $dump;
//        }
//
//        if(!is_null($model)) {
//            foreach ($dumps as $key => $dump) {
//                if($dump['model'] != $model) {
//                    unset($dumps[$key]);
//                }
//            }
//        }

        $dumps = [];

        foreach (glob('dumps/nbc/processed/*' , GLOB_ONLYDIR) as $dir) {
            $dumps[] = explode('/', $dir)[3];
        }

        return $dumps;
    }

    public function getDetails($gallery, $randomize = FALSE) {
//        $details['images'] = glob('dumps/nbc/'.$gallery.'/*.jpg', GLOB_BRACE);
//        $details['gallery'] = $gallery;

        $details['images'] = glob('dumps/nbc/processed/'.$gallery.'/*.jpg', GLOB_BRACE);
        $details['gallery'] = $gallery;

        return $details;
    }

    #[Route('/nbc')]
    public function list(): Response {
        return $this->render('nbc/list.html.twig', [
            'dumps' => $this->getDumps(NULL),
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/nbc/model/{model}')]
    public function taggedList($model): Response {
        return $this->render('nbc/list.html.twig', [
            'dumps' => $this->getDumps($model),
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/nbc/{gallery}')]
    public function detail($gallery): Response {
        return $this->render('nbc/detail.html.twig', [
            'details' =>  $this->getDetails($gallery),
        ]);
    }
}