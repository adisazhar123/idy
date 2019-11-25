<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\Author;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaRepository;

class CreateNewIdeaService
{
    private $ideaRepository;

    public function __construct(
        IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    public function handle(CreateNewIdeaRequest $request)
    {
        try {
            $idea = Idea::makeIdea($request->getIdeaTitle(), $request->getIdeaDescription(), new Author($request->getAuthorName(), $request->getAuthorEmail()));
            $response = $this->ideaRepository->save($idea);

            return new CreateNewIdeaResponse($response, "Idea created successfully.");
        } catch (\Exception $exception) {
            return new CreateNewIdeaResponse($exception, $exception->getMessage(), true);
        }
    }

}