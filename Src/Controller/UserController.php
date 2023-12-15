<?php

namespace Controller;

use Model\User;

/**
 * @OA\Info(title="RESTFull  E-Commerce API", 
 * version="1.0", 
 * description="developed for personal purposes")
 */

class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/v1/user",
     *     summary= " User list",
     *     description="Returns a list of a ll users",
     *     @OA\Response(response="200", description="All Users"),
     *     @OA\Response(response="404", description="Not Found")
    * )
    */
    public function index()
    {
        $userModel = new User();
        $users = $userModel->get();

        echo json_encode($users);

    }

    /**
     * @OA\Post(
     *     path="/api/v1/user",
     * @OA\Response(response="201", description="Created")
     * )
     */
    public function store()
    {
        $userModel = new User();
        $userModel->save([
            'name' => 'Sima',
            'email' => 'sima@support.io'
        ]);

    }
}