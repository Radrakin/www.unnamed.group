<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MongoController extends AbstractController
{
    private function getMongoClient()
    {
        return new \MongoDB\Client(getenv('MONGODB_URL'));
    }

    public function mongoGetDatabases()
    {
        try {
          $client = $this->getMongoClient();

          foreach ($client->listDatabases() as $databaseInfo) {
              $returnArr[] = (array)$databaseInfo;
          }

          return new JsonResponse([ "success" => 1, "message" => $returnArr ], Response::HTTP_OK);
        } catch (\Exception $e) {
          return new JsonResponse(["success" => 0, "message" => "generic error 20"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    public function getCollectionDocuments($database = null, $collection = null)
    {
        try {
          $client = $this->getMongoClient();

          $collection = $client->selectCollection($database, $collection);

          foreach ($collection->find() as $document) {
              $returnArr[] = (array)$document;
          }

          return new JsonResponse([ "success" => 1, "message" => $returnArr ], Response::HTTP_OK);
        } catch (\Exception $e) {
          return new JsonResponse(["success" => 0, "message" => "generic error 20"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    public function insertOne($database = null, $collection = null, $data = null)
    {
        if ($database && $collection && $data) {
            $result = ($this->getMongoClient())
                        ->selectCollection($database, $collection)
                        ->insertOne($data);

            return new JsonResponse([
              "success" => 1,
              "message" => sprintf("Inserted %d document(s)\n", $result->getInsertedCount())
            ], Response::HTTP_OK);
        } else {
            return new JsonResponse(["success" => 0, "message" => "missing parameters"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    public function findExact($database = null, $collection = null, $findCriteria = null)
    {
        if ($database && $collection && $findCriteria) {
            $cursor = ($this->getMongoClient())->$database->$collection->find($findCriteria);

            $returnArr = [];

            foreach ($cursor as $_x) {
                $returnArr[] = (array)$_x;
            }

            return new JsonResponse(["success" => "1", "message" => $returnArr], Response::HTTP_OK);
        } else {
            return new JsonResponse(["success" => 0, "message" => "missing parameters"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    public function deleteOne($database = null, $collection = null, $findCriteria = null)
    {
        if ($database && $collection && $findCriteria) {
            $deleteResponse = ($this->getMongoClient())->$database->$collection->deleteOne($findCriteria);

            return new JsonResponse(["success" => "1", "message" => $deleteResponse], Response::HTTP_OK);
        } else {
            return new JsonResponse(["success" => 0, "message" => "missing parameters"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }

    public function sumCommonFields($database = null, $collection = null, $findCriteria = null, $sumTarget = null)
    {
        if ($database && $collection && $findCriteria && $sumTarget) {
            $cursor = ($this->getMongoClient())->$database->$collection->find($findCriteria);

            $returnSum = 0;

            foreach ($cursor as $_x) {
                $returnSum = $returnSum + $_x->goodBoyPoints;
            }

            return new JsonResponse(["success" => "1", "message" => $returnSum], Response::HTTP_OK);
        } else {
            return new JsonResponse(["success" => 0, "message" => "missing parameters"], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(["success" => 0, "message" => "generic error"], Response::HTTP_BAD_REQUEST);
    }
}
