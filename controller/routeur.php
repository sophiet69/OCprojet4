<?php
session_start ();

include_once('controller/frontend.php');

/*include_once('controller/Backend.php');*/


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
                    "editComment" 	=> ["controller"=>"Frontend", "method" => 'editComment'],
                    "updateComment" 	=> ["controller"=>"Frontend", "method" => 'updateComment'],
                    "signalComment" =>["controller"=>"Frontend", "method" => 'signalComment'],
                    "connect"		=> ["controller"=> 'Frontend', "method" => 'connectProcess']
                        ];

	/*private $routesAdmin = [
              "adminchapters"		=> ["controller"=> 'Backend', "method" => 'adminchapters'],
              "adminAddChapter"		=> ["controller"=> 'Backend', "method" => 'adminAddChapter'],
              "adminDeleteChapter"	=> ["controller"=> 'Backend', "method" => 'adminDeletechapter'],
              "adminUpdatePageChapter"	=> ["controller"=> 'Backend', "method" => 'adminUpdatePageChapter'],
              "adminCommentsPage"	=> ["controller"=> 'Backend', "method" => 'adminCommentsPage'],
              "adminUpdateChapter"	=> ["controller"=> 'Backend', "method" => 'adminUpdateChapter'],
              "deleteComment"		=> ["controller"=> 'Backend', "method" => 'adminDeleteComment'],
              "deleteFastComment"	=> ["controller"=> 'Backend', "method" => 'adminFastDeleteComment'],
              "valideComment"		=> ["controller"=> 'Backend', "method" => 'adminValideComment'],
              "fastValideComment"	=> ["controller"=> 'Backend', "method" => 'adminFastValideComment'],
              "adminUpdatePageComment"	=> ["controller"=> 'Backend', "method" => 'adminUpdatePageComment'],
              "adminUpdateComment"	=> ["controller"=> 'Backend', "method" => 'adminUpdateComment'],
              "destroy"	=> ["controller"=> 'Backend', "method" => 'sessiondestroy']
						];

*/
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
			/*elseif (key_exists($request, $this->routesAdmin))
			{
				if (isset($_SESSION['login'])) // verifie qu'une session existe
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
			}*/
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
