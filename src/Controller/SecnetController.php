<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecnetController extends AbstractController
{
    private function secnetCommonData()
    {
        return [
            "discord" => [
                "username" => $this->getUser()->getDiscordUsername(),
                "id" => $this->getUser()->getDiscordId(),
                "avatarHash" => $this->getUser()->getDiscordAvatarHash(),
                "avatarUrl" => "https://cdn.discordapp.com/avatars/" . $this->getUser()->getDiscordId() . "/" . $this->getUser()->getDiscordAvatarHash(),
            ]
        ];
    }

    /**
     * @Route("/secnet", name="secnet/home")
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->render('secnet/index.html.twig', [
                "secnetCommonData" => $this->secnetCommonData()
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/secnet/loadouts", name="secnet/loadouts")
     */
    public function loadouts()
    {
        if ($this->getUser()) {
            $public1 = json_decode($this->forward('App\Controller\APIController::listPublicLoadouts')->getContent(), true);
            $public2 = json_decode($public1["message"][0], true)["message"];

            $personal1 = json_decode($this->forward('App\Controller\APIController::listPersonalLoadouts')->getContent(), true);
            $personal2 = json_decode($personal1["message"][0], true)["message"];

            return $this->render('secnet/loadouts/index.html.twig', [
                "secnetCommonData" => $this->secnetCommonData(),
                'loadouts' => [
                  "public" => $public2,
                  "personal" => $personal2
                ]
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/secnet/loadouts/create", name="secnet/loadouts/create")
     */
    public function loadoutsCreate()
    {
        if ($this->getUser()) {
            return $this->render('secnet/loadouts/create.html.twig', [
                "secnetCommonData" => $this->secnetCommonData()
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/secnet/stats", name="secnet/stats")
     */
    public function stats()
    {
        if ($this->getUser()) {
            return $this->render('secnet/stats.html.twig', [
                "secnetCommonData" => $this->secnetCommonData(),
                "statsBundle" => [
                  "id" => $this->getUser()->getDiscordId(),
                  "name" => $this->getUser()->getDiscordUsername(),
                  "avatarUrl" => "https://cdn.discordapp.com/avatars/" . $this->getUser()->getDiscordId() . "/" . $this->getUser()->getDiscordAvatarHash(),
                  "goodBoyPoints" => $this->forward('App\Controller\APIController::getUserGoodBoyPoints')->getContent()
                ]
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
