<?php

namespace App;

use Closure;

class MVC
{
    private $routes = [];
    private $namespace = '';
    private $viewDir;

    public function setControllerNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    public function setViewDirectory($dir)
    {
        $this->viewDir = $dir;
    }

    public function get($path, $callback)
    {
        $this->routes[] = [
            'type' => 'GET:' . $path,
            'callable' => $this->getCallable($callback),
        ];
    }

    public function post($path, $callback)
    {
        $this->routes[] = [
            'type' => 'POST:' . $path,
            'callable' => $this->getCallable($callback),
        ];
    }

    public function middleware($callback)
    {
        $this->routes[] = [
            'type' => 'MIDDLEWARE',
            'callable' => $this->getCallable($callback),
        ];
    }

    private function getCallable($callback)
    {
        if ($callback instanceof Closure) {
            return $callback->bindTo($this);
        } elseif (is_string($callback)) {
            $splitted = explode(':', $callback);
            $className = $this->namespace . $splitted[0];
            $instance = new $className($this);
            return [$instance, $splitted[1]];
        }
    }

    public function render($name, array $args = [])
    {
        $view = $this->viewDir . $name . '.php';
        extract($args);
        include_once $view;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $filename = $_SERVER['SCRIPT_NAME'];
        $path = parse_url('http://a.b' . $_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $len = strlen($filename);
        if (strncmp($filename, $path, $len) === 0) {
            $path = substr($path, $len);
            $path = $path === '' ? '/' : $path;
        }

        foreach ($this->routes as $route) {
            if ($route['type'] == 'MIDDLEWARE') {
                $route['callable']($_REQUEST);
            }
            if ($route['type'] == $method . ':' . $path) {
                $route['callable']($_REQUEST);
                break;
            }
        }
    }
}