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
        echo "you have no power here XD";
        die;
    }
}
