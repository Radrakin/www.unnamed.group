<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecnetController extends AbstractController
{
    /**
     * @Route("/secnet", name="secnet")
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->render('secnet/index.html.twig');
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
