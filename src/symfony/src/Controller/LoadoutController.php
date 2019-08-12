<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoadoutController extends AbstractController
{

  //TODO: these are gross, I don't like it :<

  /**
   * @Route("/loadouts", name="loadouts")
   */
  public function index()
  {
    $listLoadouts = json_decode($this->forward('App\Controller\APIController::listLoadouts')->getContent(), true);
    $listLoadoutsFinal = json_decode($listLoadouts["message"][0], true)["message"];

    return $this->render('loadout/index.html.twig', [
        'returnSingleLoadout' => false,
        'loadoutsData' => $listLoadoutsFinal
    ]);
  }

  /**
   * @Route("/loadouts/{code}", methods={"GET"}, name="loadouts/get")
   */
  public function indexGet(string $code)
  {
    $loadout = json_decode($this->forward('App\Controller\APIController::getLoadoutFromCode', ["loadoutCode" => $code])->getContent(), true);
    $loadoutFinal = json_decode($loadout["message"][0], true)["message"][0]["content"];

    return $this->render('loadout/index.html.twig', [
        'returnSingleLoadout' => true,
        'loadout' => $loadoutFinal
    ]);
  }
}
