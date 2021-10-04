<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Auth extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = UserModel::class;

    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[255]'
        ];

        $input = $this->getRequestInput();

        if (!$this->validate($rules)) {
            return $this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_OK
                );
        }

        $this->model->save($input);

        return $this->getResponse(
            [
                'status' => true,
                'message' => 'Berhasil',
                'data' => []
            ],
            ResponseInterface::HTTP_OK
        );
    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[1]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput();

        if (!$this->validate($rules, $errors)) {
            return $this->getResponse(
                    [
                        'status' => false,
                        'message' => $this->validator->getErrors()
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

        return $this->getJWTForUser($input['email']);
    }

    private function getJWTForUser(
        string $emailAddress,
        int $responseCode = ResponseInterface::HTTP_OK
    ) {
        try {
            $user = $this->model->findUserByEmailAddress($emailAddress);
            unset($user['password']);

            helper('jwt');

            $setSession = [
                //'id' => $user['user_id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'logged_in' => true
            ];

            $this->session->set($setSession);

            return $this->getResponse(
                [
                    'status' => true,
                    'message' => 'User authenticated successfully',
                    'data' => $user,
                    'access_token' => getSignedJWTForUser($emailAddress)
                ]
            ); 
        } catch (Exception $exception) {
            return $this->getResponse(
                    [
                        'status' => false,
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
