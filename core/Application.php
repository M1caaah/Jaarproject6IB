<?php

namespace app\core;
class Application
{
    public static string $ROOT_DIR;
    public static Application $app;

    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Controller $controller;
    public Database $db;
    public ?UserModel $user;

    public function __construct($rootPath, $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login($user)
    {
        $this->user = $user;
        $className = get_class($user);
        $primaryKey = $className::primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
    public static function isAdmin()
    {
        return self::$app->user->role_id === 1;
    }
}