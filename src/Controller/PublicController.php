<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use RestCord\DiscordClient as RestCord;
use Google\Cloud\Storage\StorageClient;
use Symfony\Component\HttpFoundation\Response;

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
        $storage = new StorageClient([
            'projectId' => 'zeue-net'
        ]);
        $storage->registerStreamWrapper();

        $galleryImages = array_diff(scandir("gs://files.unnamed.group/images/gallery"), array('images/gallery/'));

        shuffle($galleryImages);

        return $this->render('public/media.html.twig', [
            "youtubeVideos" => [
                "Wm4ocicYda0",
                "L6-uUQIm1sM",
                "nJ3B3kTtGaY",
                "7yt6PE3IoDo",
                "cyMVGzkk_dM",
                "kJMaQjsElb8"
            ],
            "galleryImages" => $galleryImages
        ]);
    }

    /**
     * @Route("/files", name="files")
     */
    public function files()
    {
        return $this->render('public/files.html.twig');
    }

    /**
     * @Route("/join", name="join")
     */
    public function join()
    {
        return $this->render('public/join.html.twig');
    }
}
