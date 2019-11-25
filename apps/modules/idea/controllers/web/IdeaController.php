<?php

namespace Idy\Idea\Controllers\Web;

use Idy\Idea\Application\CreateNewIdeaRequest;
use Idy\Idea\Application\RateIdeaRequest;
use Idy\Idea\Application\VoteIdeaRequest;
use Phalcon\Mvc\Controller;

class IdeaController extends Controller
{
    protected $viewAllIdeasService;
    protected $createNewIdeaService;
    protected $voteIdeaService;
    protected $rateIdeaService;

    public function initialize()
    {
        $this->viewAllIdeasService = $this->di->get('viewAllIdeasService');
        $this->createNewIdeaService = $this->di->get('createNewIdeaService');
        $this->voteIdeaService = $this->di->get('voteIdeaService');
        $this->rateIdeaService = $this->di->get('rateIdeaService');
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
        $request = new VoteIdeaRequest($this->request->getPost('ideaId'));
        $response = $this->voteIdeaService->handle($request);

        $response->getError()
            ? $this->flashSession->error($response->getMessage())
            : $this->flashSession->success($response->getMessage());

        return $this->response->redirect('');
    }

    public function rateAction()
    {
        $ideaId = $this->request->getPost('ideaId');
        $value = $this->request->getPost('value');
        $name = $this->request->getPost('name');

        $request = new RateIdeaRequest($ideaId, $value, $name);
        return $this->rateIdeaService->handle($request)->getMessage();
    }

}