<?php

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Interop\Container\ContainerInterface;
use Slim\Interfaces\RouterInterface;
use function DI\get;

return [
	
	//'router' => get(Slim\Router::class),
 	'router' =>  DI\object(Slim\Router::class),

	Twig::class => function (ContainerInterface $c){

		$twig = new Twig(__DIR__ . '/../resources/views', [
			'debug' => true,
			'cache' => false
		]);

		$twig->addExtension(new TwigExtension(

			$c->get('router'),
			$c->get('request')->getUri()
		));

		 $twig->addExtension(new Twig_Extension_Debug());

		return $twig;
	}

];