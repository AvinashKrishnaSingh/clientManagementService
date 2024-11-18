<!-- Router.php -->
<?php

// Middleware class for handling authentication and authorization
class Middleware {
    private $session;

    public function __construct($session) {
        $this->session = $session;
    }

    public function isLoggedIn() {
        return isset($this->session['user_id']);
    }

    public function isRestrictedUrl($url) {
        $restricted_urls = [
            '/setupDatabase',
        ];
        return in_array($url, $restricted_urls);
    }

    public function redirectToLogin() {
        header("Location: /CMS/landing");
        exit();
    }
}

class Router {
    private $routes;
    private $middleware;

    public function __construct($routes, $middleware) {
        $this->routes = $routes;
        $this->middleware = $middleware;
    }

    public function route() {
        $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];

        // Adjust request path to strip out the project directory
        $basePath = '/CMS'; // Set to your folder name in htdocs
        $request_path = str_replace($basePath, '', $request_uri);

        // Middleware for restricted URLs
        if (isset($this->middleware[$request_method])) {
            if ($this->middleware[$request_method]->isRestrictedUrl($request_path) && !$this->middleware[$request_method]->isLoggedIn()) {
                $this->middleware[$request_method]->redirectToLogin();
            }
        }

        // Default route
        $controller = 'IndexController';
        $action = 'index';

        foreach ($this->routes[$request_method] ?? [] as $route => $handler) {
            $pattern = str_replace('/', '\/', $route);
            if (preg_match("/^$pattern$/", $request_path, $matches)) {
                list($controller, $action) = explode('@', $handler);
                array_shift($matches);

                require_once "inc/Controllers/$controller.php";

                $controllerObject = new $controller();
                $controllerObject->$action(...$matches);
                exit();
            }
        }

        $this->notFound();
    }

    private function notFound() {
        echo "404 Not Found";
        exit();
    }
}

// Initialize session
require_once __DIR__ . '/../helpers/session_helper.php';
$session = $_SESSION;

// Initialize middleware
$middleware = [
    'GET' => new Middleware($session),
    'POST' => new Middleware($session),
];

// Define routes
$routes = [
    'GET' => [
        '/' => 'IndexController@initializedbview',
        '/landing' => 'IndexController@landingPage',
    ],
    'POST' => [
        '/setupDatabase' => 'DatabaseController@setupDatabase',
        '/landing' => 'IndexController@landingPage',
    ],
];

// Initialize router
$router = new Router($routes, $middleware);
$router->route();


