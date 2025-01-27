<?php

namespace Core;

class Application
{
    protected string $uri;

    public Request $request;

    public Response $response;

    public Router $router;

    public View $view;

    public static Application $app;

    public Database $db;

    public function __construct()
    {
        self::$app = $this;
       
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);
        $this->db = new Database();

    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }
}