<?php
session_start ();

include_once('controller/frontend.php');
include_once('controller/backend.php');


class Routeur
{
	private $request;

	private $routes = 	[
                    "" 			    => ["controller"=> 'Frontend', "method" => 'home'],
                    "home" 			=> ["controller"=> 'Frontend', "method" => 'home'],
                    "login"	=> ["controller"=> 'Frontend', "method" => 'login'],
                    "listPosts"		=> ["controller"=> 'Frontend', "method" => 'listPosts'],
                    "post"		=> ["controller"=> 'Frontend', "method" => 'post'],
                    "addComment" 	=> ["controller"=>"Frontend", "method" => 'addComment'],
                    "signalComment" =>["controller"=>"Frontend", "method" => 'signalComment'],
                    "destroy"		=> ["controller"=> 'Frontend', "method" => 'destroy']
                        ];

	private $routesAdmin = [
              "admin"		=> ["controller"=> 'Backend', "method" => 'admin'],
              "postB"		=> ["controller"=> 'Backend', "method" => 'postB'],
              "updatePost"	=> ["controller"=> 'Backend', "method" => 'displayUpdate'],
              "submitUpdate"	=> ["controller"=> 'Backend', "method" => 'submitUpdate'],
              "createPost"	=> ["controller"=> 'Backend', "method" => 'displayCreatePost'],
              "submitPost"	=> ["controller"=> 'Backend', "method" => 'newPost'],
              "deletePost"	=> ["controller"=> 'Backend', "method" => 'removePost'],
              "deleteComment"	=> ["controller"=> 'Backend', "method" => 'removeComment']
						];


	public function __construct($request)
	{
		$this->request = $request;
	}

	public function renderController()
	{
		$request = $this->request;

		try
		{
			if(key_exists($request, $this->routes))
			{
				$controller = $this->routes[$request]['controller'];
				$method 	= $this->routes[$request]['method'];

				$currentController = new $controller();
				$currentController->$method();
			}
			elseif (key_exists($request, $this->routesAdmin))
			{
				if (isset($_SESSION['id'])) // verifie qu'une session existe
				{
					$controller = $this->routesAdmin[$request]['controller'];
					$method 	= $this->routesAdmin[$request]['method'];

					$currentController = new $controller();
					$currentController->$method();
				}
				else
				{
					throw new Exception(' vous n\'avez pas accès, veuillez vous connecter');
				}
			}
			else
			{
				throw new Exception(' 404 aucune page trouvée');
			}
		}
		catch(Exception $e)
		{
			$messageError = new Frontend();
			$message = $messageError->error($e);
		}
	}
}
