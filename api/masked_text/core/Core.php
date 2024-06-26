<?php
class Core{

	public function exec(){
		//criando uma instancia do roteador
		$router = new Router();

		//configurar as rotas
		$router->addRoute('/', array(new maskController(), 'index'));
		$router->addRoute('/mask', array(new maskController(), 'mask'));
		$router->addRoute('/unmask', array(new maskController(), 'unmask'));
		$router->addRoute('/list', array(new maskController(), 'listMask'));
		$router->addRoute('/setinputmask', array(new maskController(), 'setinputmask'));

		//lidando com a requisição
		$route = isset($_GET['route'])?'/'.$_GET['route']:'/';

		$router->handleRequest($route);
	}

}
