<?php declare(strict_types = 1);

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');
$injector->alias('YourNamespaceApp\Template\Renderer', 'YourNamespaceApp\Template\TwigRenderer');
$injector->delegate('Twig_Environment', function () use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});
$injector->alias('YourNamespaceApp\Template\FrontendRenderer', 'YourNamespaceApp\Template\FrontendTwigRenderer');
$injector->alias('YourNamespaceApp\Menu\MenuReader', 'YourNamespaceApp\Menu\ArrayMenuReader');
$injector->share('YourNamespaceApp\Menu\ArrayMenuReader');
$injector->share('YourNamespaceApp\Database\Connection');

return $injector;