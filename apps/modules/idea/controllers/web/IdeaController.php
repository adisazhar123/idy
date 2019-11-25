<?php

namespace Idy\Idea\Controllers\Web;

use Phalcon\Mvc\Controller;

class IdeaController extends Controller
{
    protected $viewAllIdeasService;

    public function initialize()
    {
        $this->viewAllIdeasService = $this->di->get('viewAllIdeasService');
    }

    public function indexAction()
    {
        $response = $this->viewAllIdeasService->handle();
//        print_r($response->get()[1]->averageRating());
//        return false;
        $this->view->ideas = $response->get();
        return $this->view->pick('home');
    }

    public function addAction()
    {

    }

    public function voteAction()
    {

    }

    public function rateAction()
    {
        
    }

}