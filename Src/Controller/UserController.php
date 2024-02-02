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

    /**
     * @OA\Post(
     *     path="/api/v1/user/register",
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"username", "password"},
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function register()
    {
        
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        header('Content-Type: application/json');

        $newUser = new User();
        $newUser->save([
            "name" => $data["username"],
            "email" => $data["email"],
            "password" => $data['password']
        ]);
        echo json_encode($data);
        
    }
}