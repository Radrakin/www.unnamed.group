<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/api/dev/testMongo", name="api/dev/testMongo")
     */
    public function testMongo()
    {
        $r = $this->forward('App\Controller\MongoController::insertOne', [
          "database" => "uagpmc-com",
          "collection" => "logs",
          "data" => ["testField" => "success!"]
        ]);

        return new Response("did it work?");
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
     * @Route("/api/discord/token/new", name="api/discord/token/new")
     */
    public function discordTokenNew($data = null)
    {
        try {
          $mongoResponse = $this->forward('App\Controller\MongoController::insertOne', [
            "database" => "uagpmc-com",
            "collection" => "users",
            "data" => $data
          ]);

          if ($mongoResponse->getStatusCode() == Response::HTTP_OK) {
            return new JsonResponse([ "success" => 1, "message" => "mongodb connection successful" ], Response::HTTP_OK);
          } else {
            return new JsonResponse([ "success" => 0, "message" => "generic error" ], Response::HTTP_BAD_REQUEST);
          }

        } catch (\Exception $e) {
          throw $e;
          return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/discord/token/check", name="api/discord/token/check")
     */
    public function discordTokenCheck($token = null)
    {
        try {
          $mongoResponse = $this->forward('App\Controller\MongoController::findExact', [
            "database" => "uagpmc-com",
            "collection" => "users",
            "data" => [
              "token" => $token
            ]
          ]);

          if ($mongoResponse->getStatusCode() == Response::HTTP_OK) {
            return new JsonResponse([ "success" => 1, "message" => "mongodb connection successful" ], Response::HTTP_OK);
          } else {
            return new JsonResponse([ "success" => 0, "message" => "generic error" ], Response::HTTP_BAD_REQUEST);
          }

        } catch (\Exception $e) {
          throw $e;
          return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }
}
