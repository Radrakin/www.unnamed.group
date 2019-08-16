<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use RestCord\DiscordClient as RestCord;

class APIController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return new JsonResponse(["success" => "1", "message" => "api endpoint online"], Response::HTTP_OK);
    }

    /**
     * @Route("/api/database/test", name="api/database/test")
     */
    public function databaseTest()
    {
        try {
          $mongoResponse = $this->forward('App\Controller\MongoController::mongoGetDatabases');

          if ($mongoResponse->getStatusCode() == Response::HTTP_OK) {
            return new JsonResponse([ "success" => 1, "message" => "mongodb connection successful" ], Response::HTTP_OK);
          } else {
            return new JsonResponse([ "success" => 0, "message" => "generic error" ], Response::HTTP_BAD_REQUEST);
          }

        } catch (\Exception $e) {
          return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/user/gbp", name="api/user/gbp")
     */
    public function getUserGoodBoyPoints()
    {
        if (!$this->getUser()) {
          return new JsonResponse(["success" => 0, "message" => "you are not a user"], Response::HTTP_BAD_REQUEST);
        } else {
          try {
            $mongoResponse = $this->forward('App\Controller\MongoController::sumCommonFields', ["database" => "uagpmc-com", "collection" => "goodBoyPoints", "findCriteria" => ["discordId" => $this->getUser()->getDiscordId()], "sumTarget" => "goodBoyPoints"]);

            return new JsonResponse(json_decode($mongoResponse->getContent(), true)["message"], Response::HTTP_OK);
          } catch (\Exception $e) {
            return new JsonResponse([ "success" => 0, "message" => "mongo said no" ], Response::HTTP_BAD_REQUEST);
          }
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    /**
  	 * @Route("/api/loadouts/get", name="api/loadouts/get")
  	 */
  	public function getLoadoutFromCode($loadoutCode = null) {
      $loadoutCode = (isset($_GET["code"])) ? $_GET["code"] : $loadoutCode;
      try {
        $loadoutFind = $this->forward('App\Controller\MongoController::findExact', ["database" => "uagpmc-com", "collection" => "loadouts", "findCriteria" => ["code" => $loadoutCode]]);

        $loadout = (array)$loadoutFind->getContent();

        return new JsonResponse([ "success" => 1, "message" => $loadout ], Response::HTTP_OK);
      } catch (\Exception $e) {
        return new JsonResponse([ "success" => 0, "message" => "mongo said no" ], Response::HTTP_BAD_REQUEST);
      }

  		return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
  	}

    /**
     * @Route("/api/loadout/{code}", methods={"GET"}, name="loadout/get")
     */
    public function indexGet(string $code)
    {
      $apiRes = json_decode($this->forward('App\Controller\APIController::getLoadoutFromCode', ["loadoutCode" => $code])->getContent(), true);
      $loadout = json_decode($apiRes["message"][0], true)["message"][0];

      $loadoutFinal = "";

      if (strlen($loadout["parent"]) > 0) {
        try {
          $apiResParent = json_decode($this->forward('App\Controller\APIController::getLoadoutFromCode', ["loadoutCode" => $loadout["parent"]])->getContent(), true);
          $loadoutFinal .= json_decode($apiResParent["message"][0], true)["message"][0]["content"];
        } catch (\Exception $e) {
          $loadoutFinal .= "hint 'parent ID set, but cannot find it in database!';";
        }
        $apiResParent = json_decode($this->forward('App\Controller\APIController::getLoadoutFromCode', ["loadoutCode" => $loadout["parent"]])->getContent(), true);
        $loadoutFinal .= json_decode($apiResParent["message"][0], true)["message"][0]["content"];
      } else {
        $loadoutFinal .= "comment 'no parent ID set, skipping parent import';";
      }

      $loadoutFinal .= ";;;".$loadout["content"];

      return $this->render('loadout/index.html.twig', [
          'returnSingleLoadout' => true,
          'loadout' => $loadoutFinal
      ]);
    }

    /**
     * @Route("/api/user/loadout/{code}/delete", methods={"GET"}, name="user/loadout/get/delete")
     */
    public function userLoadoutGetDelete(string $code)
    {
      $deleteResponse = json_decode($this->forward('App\Controller\MongoController::deleteOne', ["database" => "uagpmc-com", "collection" => "loadouts", "findCriteria" => ["code" => $code, "owner" => $this->getUser()->getDiscordId()]])->getContent(), true);

      if (isset($_GET["redirect"])) {
        if ($_GET["redirect"] === "n4db3n") {
          return $this->redirectToRoute("secnet/loadouts", ["s" => "d1", '_fragment' => 'personaltab']);
        }
      }

      return new JsonResponse([ "success" => 1, "message" => $deleteResponse ], Response::HTTP_OK);
    }

	/**
	 * @Route("/api/loadouts/list", name="api/loadouts/list")
	 */
	public function listPublicLoadouts() {
    try {
      $loadoutsCollection = $this->forward('App\Controller\MongoController::findExact', ["database" => "uagpmc-com", "collection" => "loadouts", "findCriteria" => ["scope" => "public"]]);

      foreach ((array)$loadoutsCollection->getContent() as $key => $value) {
        $returnArr[$key] = $value;
      }

      return new JsonResponse([ "success" => 1, "message" => $returnArr ], Response::HTTP_OK);
    } catch (\Exception $e) {
      return new JsonResponse([ "success" => 0, "message" => "mongo said no" ], Response::HTTP_BAD_REQUEST);
    }

		return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
	}

	/**
	 * @Route("/api/user/loadouts", name="api/user/loadouts")
	 */
	public function listPersonalLoadouts() {
    try {
      $loadoutsCollection = $this->forward('App\Controller\MongoController::findExact', ["database" => "uagpmc-com", "collection" => "loadouts", "findCriteria" => ["scope" => "personal", "owner" => $this->getUser()->getDiscordId()]]);

      foreach ((array)$loadoutsCollection->getContent() as $key => $value) {
        $returnArr[$key] = $value;
      }

      return new JsonResponse([ "success" => 1, "message" => $returnArr ], Response::HTTP_OK);
    } catch (\Exception $e) {
      return new JsonResponse([ "success" => 0, "message" => "mongo said no" ], Response::HTTP_BAD_REQUEST);
    }

		return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
	}

	/**
	 * @Route("/api/user/loadout/create", name="api/user/loadout/create")
	 */
	public function createPersonalLoadout() {
    try {
      function zeue_random()
      {
          $data = random_bytes(16);
          $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
          $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
          return vsprintf('%s%s%s', str_split(bin2hex($data), 4));
      }

      $loadoutCode = zeue_random();

      $dataToSend = [
        "code" => $loadoutCode,
        "name" => $_POST["name"],
        "faction" => $_POST["faction"],
        "camo" => $_POST["camo"],
        "terrains" => $_POST["terrains"],
        "parent" => $_POST["parent"],
        "description" => $_POST["name"],
        "image" => $_POST["imageB64"],
        "content" => $_POST["content"],
        "scope" => "personal",
        "owner" => $this->getUser()->getDiscordId()
      ];

      $loadoutsCollection = $this->forward('App\Controller\MongoController::insertOne', ["database" => "uagpmc-com", "collection" => "loadouts", "data" => $dataToSend]);

      if ($_POST["origin"] === "page/create") {
        return $this->redirectToRoute("secnet/loadouts", ["s" => "c1", '_fragment' => 'personaltab']);
      }

      return new JsonResponse([ "success" => 1, "message" => "loadout submitted!", "loadoutCode" => $loadoutCode ], Response::HTTP_OK);
    } catch (\Exception $e) {
      return new JsonResponse([ "success" => 0, "message" => "mongo said no" ], Response::HTTP_BAD_REQUEST);
    }

		return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
	}

}
