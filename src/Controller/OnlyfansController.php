<?php
// src/Controller/OnlyfansController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OnlyfansController extends AbstractController
{

    private $onlyfans_log = 'onlyfans.yaml';
    public function getDumps($tag) {
        $dumps = \Spyc::YAMLLoad('onlyfans.yaml');
        foreach($dumps as $key => $dump) {
//            $dumps[$key]['count'] = count(glob('thumbs/onlyfans/'.$key.'/*.webp', GLOB_BRACE));

//            if(empty($dumps[$key]['count'])) {
//                $dumps[$key]['count'] = count(glob('thumbs/onlyfans/'.$key.'/*.webp', GLOB_BRACE));
//            }
//
//            if(!str_contains($dumps[$key]['previews']['portrait'], '"')) {
//                $dumps[$key]['previews']['portrait'] = "\"".$dumps[$key]['previews']['portrait']."\"";
//            }
//
//            if(!str_contains($dumps[$key]['previews']['landscape'], '"')) {
//                $dumps[$key]['previews']['landscape'] = "\"".$dumps[$key]['previews']['landscape']."\"";
//            }

            if(!is_null($tag) && !in_array($tag, $dump['tags'])) {
                unset($dumps[$key]);
            }
        }
        return $dumps;
    }

    public function getTags() {
        $data = \Spyc::YAMLLoad('onlyfans.yaml');
        $tags = [];
        foreach ($data as $creator) {
            foreach($creator['tags'] as $tag) {
                $tags[] = $tag;
            }
        }
        $tags = array_unique($tags);
        asort($tags);
        return $tags;
    }

    public function getDetails($creator, $randomize = FALSE) {
        $details = \Spyc::YAMLLoad('onlyfans.yaml')[$creator];
        $details['images'] = glob('thumbs/onlyfans/'.$creator.'/*.webp', GLOB_BRACE);
        $details['count'] = count($details['images']);
        $details['initial'] = 1000;

        if($randomize) {
            $details = array_reverse($details);
        }

        if(isset($details['random'])) {
            shuffle($details['images']);
        }
        return $details;
    }

    public function getVideos($creator, $randomize = FALSE) {
    $details = \Spyc::YAMLLoad('onlyfans.yaml')[$creator];
    $details['videos'] = glob('dumps/onlyfans/'.$creator.'/videos/*.png', GLOB_BRACE);
    $details['count'] = count($details['videos']);

    return $details;
}

    #[Route('/onlyfans')]
    public function list(): Response {
        return $this->render('onlyfans/list.html.twig', [
            'dumps' => $this->getDumps(NULL),
            'tags' => $this->getTags(),
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/onlyfans/tag/{tag}')]
    public function taggedList($tag): Response {
        return $this->render('onlyfans/list.html.twig', [
            'dumps' => $this->getDumps($tag),
            'tag' => $tag,
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/onlyfans/{creator}/video')]
    public function video($creator): Response {
        return $this->render('onlyfans/video.html.twig', [
            'creator' => $creator,
            'details' =>  $this->getVideos($creator),
            'mode' => $_ENV['MODE'],
        ]);
    }

    #[Route('/onlyfans/{creator}/{filter}')]
    public function detail($creator, $filter = NULL): Response {
        return $this->render('onlyfans/detail.html.twig', [
            'creator' => $creator,
            'filter' => $filter,
            'details' =>  $this->getDetails($creator),
            'mode' => $_ENV['MODE'],
        ]);
    }
}