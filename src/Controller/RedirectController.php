<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    /**
     * @Route("/discord", name="discord")
     */
    public function discord()
    {
        return $this->redirect('https://discord.gg/eNkDNRh');
    }

    /**
     * @Route("/liberation", name="liberation")
     */
    public function liberation()
    {
        return $this->redirect('https://discord.gg/eNkDNRh');
    }
}