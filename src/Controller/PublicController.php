<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
