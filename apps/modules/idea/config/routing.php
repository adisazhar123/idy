<?php

$namespace = 'Idy\Idea\Controllers\Web';
$module = 'idea';

$router->addGet('/add', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => 'idea',
    'action' => 'addPage'
]);

$router->addPost('/add', [
    'namespace' => $namespace,
    'module' => $module,
    'controller' => 'idea',
    'action' => 'add'
]);

return $router;
