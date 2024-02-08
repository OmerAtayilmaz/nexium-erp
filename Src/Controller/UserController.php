<?php

namespace Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Model\User;
use Helper\Password;

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
     * @OA\Get(
     *     path="/api/v1/user/dashboard",
     *     summary="Authorized User Profile",
     *     description="Special user",
     *     security={{ "BearerAuth": {} }},
     *     @OA\Response(response="200", description="User details"),
     *     @OA\Response(response="401", description="Not Authorized"),
     *     @OA\Response(response="404", description="Not Found")
     * )
     *
     * @OA\SecurityScheme(
     *     securityScheme="BearerAuth",
     *     type="apiKey",
     *     in="header",
     *     name="Authorization",
     *     description="Enter 'Bearer' followed by a space and then your JWT token"
     * )
     */
    public function dashboard()
    {
        // Debugging: Print all incoming headers
        print_r(getallheaders());

        // Trim the Authorization header key to remove whitespace
        $authorizationHeaderKey = 'Authorization';
        if (!isset($_SERVER[$authorizationHeaderKey])) {
            http_response_code(401);
            echo json_encode(['error' => 'Authorization header missing']);
            exit;
        }

        $token = $_SERVER[$authorizationHeaderKey];

        try {
            // Debugging: Print the received token
            echo "Received Token: $token\n";

            // Verify and decode the JWT
            $decodedToken = JWT::decode($token, "your_secret_key");

            // Debugging: Print decoded token
            print_r($decodedToken);

            // Check token expiration
            if (isset($decodedToken->exp) && $decodedToken->exp < time()) {
                http_response_code(401);
                echo json_encode(['error' => 'Token has expired']);
                exit;
            }

            // Token is valid, you can access user claims
            $userId = $decodedToken->user_id;
            $username = $decodedToken->username;

            // Now you can use $userId and $username to fetch user data or perform any necessary actions

            // Respond with user profile data
            http_response_code(200);
            echo json_encode(['message' => 'Profile retrieved successfully', 'user_id' => $userId, 'username' => $username]);
        } catch (\Exception $e) {
            // Invalid token
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
        }
        exit;
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
     *                 required={"name", "password","email"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  )
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
        $data = json_decode($json, true);
        header('Content-Type: application/json');

        $newUser = new User();
        $newUser->save([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Password::hash($data['password'])
        ]);
        echo json_encode($data);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/login",
     *     summary="Log in with an existing user.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User login data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"email","password"},
     *                 @OA\Property(
     *                      property="email",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Logged in",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="user", type="object")  
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authentication failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Authentication failed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Bad Request")
     *         )
     *     )
     * )
     */
    public function login()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $email = $data['email'];
        $password = $data['password'];

        $user = new User();
        $result = $user->auth([
            'email' => $email,
            'password' => $password
        ]);

        // Set appropriate HTTP headers
        header('Content-Type: application/json');


        if ($result['status'] === 200) {
            // Authentication successful
            $jwt = $this->generateJWT($result);
            http_response_code(200);
            echo json_encode(['message' => 'Login successful', 'token' => "$jwt"]);
            exit;
        } else {

            http_response_code(401);
            echo json_encode(['error' => 'Authentication failed']);
            exit;
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/verify-token",
     *     summary="Verify if the token is valid or not.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Token data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"token"},
     *                 @OA\Property(
     *                      property="token",
     *                      type="string"
     *                  )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Token is valid",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Token is valid"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Authentication failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Authentication failed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Bad Request")
     *         )
     *     )
     * )
     */
    public function verify_token(){
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $token = $data['token'];

        if (!$token) {
            http_response_code(400);
            echo json_encode([ "status" => 'fail', "message" => "token is not provided."]);
            exit;
        }
    
        try {
            $decoded = JWT::decode($token, new Key("MY_AWESOME_SECRET_KEY", 'HS256'));
            // If decoding is successful, token is valid
           echo json_encode(['status'=>'success','message' => 'Token is valid'], 200);
        } catch (\Exception $e) {
            // If decoding fails, token is invalid
            echo json_encode(['status' => 'fail', 'error' => $e->getMessage()], 401);
        }
    }
    private function generateJWT($user)
    {
        $key = "MY_AWESOME_SECRET_KEY";
        $tokenPayload = [
            "user_id" => 1,
            "email" => $user['email'],
            "exp" => time() + 3600,
        ];

        return JWT::encode($tokenPayload, $key, 'HS256');
    }
}
