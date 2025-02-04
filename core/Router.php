<?php
namespace Core;

class Router
{
    protected array $routes = [];

    protected array $routesParams = [];

    public function __construct(
        protected Request $request,
        protected Response $response
    )
    {
    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path, '/');
        if(is_array(($method))) {
            array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }

        $this->routes[] = [
            'path' => "/$path",
            'callback' => $callback,
            'middleware' => null,
            'method' => $method,
        ];

        return $this;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback,'GET');
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, 'POST');
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);
        if (false === $route) {
            abort('Test 404 error');
        }

        if (is_array($route['callback'])) {
            $route['callback'][0] = new $route['callback'][0];
        }

        return call_user_func($route['callback']);
    }

    protected function matchRoute($path): mixed
    {
        foreach ($this->routes as $route) {
            if (
                preg_match("#^{$route['path']}$#", "/{$path}", $matches)
                &&
                in_array($this->request->getMethod(), $route['method'])
            ) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->routesParams[$k] = $v;
                    }
                }
                return $route;
            }
        }
        return false;
    }
}
