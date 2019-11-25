<?php

namespace Idy\Idea\Controllers\Web;

use Idy\Idea\Application\CreateNewIdeaRequest;
use Phalcon\Mvc\Controller;

class IdeaController extends Controller
{
    protected $viewAllIdeasService;
    protected $createNewIdeaService;

    public function initialize()
    {
        $this->viewAllIdeasService = $this->di->get('viewAllIdeasService');
        $this->createNewIdeaService = $this->di->get('createNewIdeaService');
    }

    public function indexAction()
    {
        $response = $this->viewAllIdeasService->handle();
        $this->view->ideas = $response->get();

        return $this->view->pick('home');
    }

    public function addPageAction()
    {
        return $this->view->pick('add');
    }

    public function addAction()
    {
        $ideaTitle = $this->request->getPost('ideaTitle');
        $ideaDescription = $this->request->getPost('ideaDescription');
        $authorName = $this->request->getPost('authorName');
        $authorEmail = $this->request->getPost('authorEmail');

        $request = new CreateNewIdeaRequest($ideaTitle, $ideaDescription, $authorName, $authorEmail);
        $response = $this->createNewIdeaService->handle($request);

        $response->getError()
            ? $this->flashSession->error($response->getMessage())
            : $this->flashSession->success($response->getMessage());

        return $this->response->redirect('');

    }

    public function voteAction()
    {
        
    }

    public function rateAction()
    {
        
    }

}