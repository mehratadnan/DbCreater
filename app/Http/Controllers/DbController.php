<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DbCreaterController;
use App\Models\Db;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class DbController extends BaseController
{

    /**
     * @return JsonResponse
     */

    public function index(): \Illuminate\Http\JsonResponse
    {
        $db = Db::all() ;
        return response()->json($db, 200)->withHeaders([
            'Content-Type' => 'application/json',
            'X-Header-One' => 'Header Value',
        ]);
    }


    /**
     * @param $id
     * @return JsonResponse
     */


    public function show($id): \Illuminate\Http\JsonResponse
    {
        $db = Db::findOrFAil($id);
        return response()->json($db, 200)->withHeaders([
            'Content-Type' => 'application/json',
            'X-Header-One' => 'Header Value',
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function update(Request $request , $id): \Illuminate\Http\JsonResponse
    {
        $db = Db::findOrFAil($id);
        $db->update($request->all());

        return response()->json('db has been updated successfully', 200)->withHeaders([
            'Content-Type' => 'application/json',
            'X-Header-One' => 'Header Value',
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */

    public function destroy(Request $request , $id): \Illuminate\Http\JsonResponse
    {
        $db = Db::findOrFAil($id);
        Db::findOrFAil($id)->delete();

        $DbCreaterController = new DbCreaterController();
        $request->request->add(['database' => $db->name]);
        $DbCreaterController->dropDatabase( $request );


        return response()->json($request->all(), 200)->withHeaders([
            'Content-Type' => 'application/json',
            'X-Header-One' => 'Header Value',
        ]);
    }


    /**
     * @param $request
     * @return JsonResponse
     */

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $db = Db::create($request->all());
        $DbCreaterController = new DbCreaterController();
        $DbCreaterController->create($request);

        return response()->json("db has been added successfully", 200)->withHeaders([
            'Content-Type' => 'application/json',
            'X-Header-One' => 'Header Value',
        ]);

    }


}


