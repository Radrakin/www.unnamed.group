<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecnetController extends AbstractController
{
    private function parseUserData()
    {
        return [
            "Discord" => [
                "Username" => $this->getUser()->getDiscordUsername(),
                "Id" => $this->getUser()->getDiscordId(),
                "AvatarHash" => $this->getUser()->getDiscordAvatarHash()
            ]
        ];
    }

    /**
     * @Route("/secnet", name="secnet")
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->render('secnet/index.html.twig', [
                "userData" => $this->parseUserData()
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
