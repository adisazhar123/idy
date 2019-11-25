<?php

use Idy\Idea\Application\CreateNewIdeaService;
use Idy\Idea\Application\RateIdeaService;
use Idy\Idea\Application\ViewAllIdeasService;
use Idy\Idea\Application\VoteIdeaService;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Idy\Idea\Infrastructure\SqlIdeaRepository;

$di['voltServiceMail'] = function($view) use ($di) {

    $config = $di->get('config');

    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
    if (!is_dir($config->mail->cacheDir)) {
        mkdir($config->mail->cacheDir);
    }

    $compileAlways = $config->mode == 'DEVELOPMENT' ? true : false;

    $volt->setOptions(array(
        "compiledPath" => $config->mail->cacheDir,
        "compiledExtension" => ".compiled",
        "compileAlways" => $compileAlways
    ));
    return $volt;
};

$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(__DIR__ . '/../views/');

    $view->registerEngines(
        [
            ".volt" => "voltService",
        ]
    );

    return $view;
};

$di['db'] = function () use ($di) {

    $config = $di->get('config');

    $dbAdapter = $config->database->adapter;

    return new $dbAdapter([
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname
    ]);
};

$di->set('ideaRepository', function() use ($di) {
    $repo = new SqlIdeaRepository($di->get('db'));

    return $repo;
});

$di->set('viewAllIdeasService', function () use ($di) {
   return new ViewAllIdeasService($di->get('ideaRepository'));
});

$di->set('createNewIdeaService', function () use ($di) {
   return new CreateNewIdeaService($di->get('ideaRepository'));
});

$di->set('voteIdeaService', function () use ($di) {
   return new VoteIdeaService($di->get('ideaRepository'));
});

$di->set('rateIdeaService', function () use ($di) {
   return new RateIdeaService($di->get('ideaRepository'));
});
