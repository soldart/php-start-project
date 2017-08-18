<?php 

/**
*
*/
class Router
{
	private $routes;
	public function __construct()
	{
		$routesPath= ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

	//returns request string
	//@return string
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}		
	}

	public function run()
	{
		// print_r($this->routes);

		//get request string
		$uri = $this->getURI();

		//Check for the presence of such a request in the routes.php
		foreach ($this->routes as $uriPattern => $path) {
			// echo $uriPattern."<br>";
			// echo $path."<br>";
			if (preg_match("~$uriPattern~", $uri)) {
				
				//Get inner path
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

				//Identify: Controller, action, options
				$segments = explode('/', $internalRoute);

				// echo '<pre>';
				// 	print_r($segments);
				// echo '</pre>';
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action'.ucfirst(array_shift($segments));

				// echo "<br>controller name: ".$controllerName;
				// echo "<br>action name: ".$actionName;
				$parameters = $segments;
				// echo "<pre>";
				// print_r($parameters);


				// die;
				// echo "<br>Class: ".$controllerName;
				// echo "<br>Method: ".$actionName;

				$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				$controllerObject = new $controllerName;
				// $result = $controllerObject->$actionName($parameters);
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				if ($result != null) {
					break;
				}
			}
		}
		
	}
}