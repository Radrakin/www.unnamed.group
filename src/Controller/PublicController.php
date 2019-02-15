<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use RestCord\DiscordClient as RestCord;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->render('public/index.html.twig', [
                "DiscordUsername" => $this->getUser()->getDiscordUsername(),
                "DiscordId" => $this->getUser()->getDiscordId(),
                "DiscordAvatarHash" => $this->getUser()->getDiscordAvatarHash()
            ]);
        } else {
            return $this->render('public/index.html.twig');
        }
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('public/about.html.twig');
    }

    /**
     * @Route("/media", name="media")
     */
    public function media()
    {
        $galleryImages = array_diff(scandir("../public/assets/img/gallery"), array('..', '.'));
        
        shuffle($galleryImages);

        return $this->render('public/media.html.twig', [
            "youtubeVideos" => [
                "L6-uUQIm1sM",
                "nJ3B3kTtGaY",
                "7yt6PE3IoDo",
                "cyMVGzkk_dM",
                "kJMaQjsElb8",
                "mJD6T3yR3D8"
            ],
            "galleryImages" => $galleryImages
        ]);
    }

    /**
     * @Route("/join", name="join")
     */
    public function join()
    {
        return $this->render('public/join.html.twig');
    }

    /**
     * @Route("/discord", name="discord")
     */
    public function discord()
    {
        return $this->redirect('https://discord.gg/eNkDNRh');
    }
}
