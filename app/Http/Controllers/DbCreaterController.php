<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDO;
use PDOException;

use Laravel\Lumen\Routing\Controller as BaseController;


class DbCreaterController extends BaseController
{

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $DB_CHARSET = 'utf8';

    /**
     * The console command signature.
     * @param Request $request
     * @var string
     */
    protected $DB_COLLATION = 'utf8_general_ci';

    public function  create(Request $request)
    {
        $this->createDatabase($request);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */

    public function createDatabase(Request $request): JsonResponse
    {
        try {
            $pdo = $this->getPDOConnection($request);
            $pdo->exec(sprintf(
                'CREATE DATABASE %s CHARACTER SET %s COLLATE %s ',
                $request->name,
                $this->DB_CHARSET,
                $this->DB_COLLATION,
            ));

            return response()->json("NO ERROR", 200);

        } catch (PDOException $exception) {
            return response()->json("ERROR", 200);
        }
    }

    public function dropDatabase(Request $request): JsonResponse
    {
        try {
            $pdo = $this->getPDOConnection($request);
            $pdo->exec(sprintf(
                'DROP DATABASE %s',
                $request->database
            ));

            return response()->json("NO ERROR", 200);

        } catch (PDOException $exception) {
            return response()->json("ERROR", 200);
        }
    }



    /**
     * @param Request $request
     * @return PDO
     */
    private function getPDOConnection(Request $request): PDO
    {
        return new PDO(sprintf('mysql:host=%s;port=%d;', $request->host, $request->port), $request->username, $request->passowrd);
    }


}


