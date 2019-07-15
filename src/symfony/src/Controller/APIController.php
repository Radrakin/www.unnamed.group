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
}
