<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\Author;
use Idy\Idea\Domain\Model\Idea;
use Idy\Idea\Domain\Model\IdeaId;
use Idy\Idea\Domain\Model\IdeaRepository;

class RateIdeaService
{
    protected $repository;

    public function __construct(IdeaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(RateIdeaRequest $request)
    {
        try {
            $ideaId = new IdeaId($request->getIdeaId());
            $ideaFromDb = $this->repository->byId($ideaId);
            $ratings = $this->repository->getRatingsByIdeaId($ideaId);
            $idea = new Idea($ideaId, $ideaFromDb['title'], $ideaFromDb['description'], $ideaFromDb['votes'], $ratings, new Author($ideaFromDb['author_name'], $ideaFromDb['author_email']));
            $rating = $idea->addRating($request->getName(), $request->getValue());

            $response = $this->repository->rate($ideaId, $rating);

            return new RateIdeaResponse($response, "Idea successfully rated.");
        } catch (\Exception $exception) {
            return new RateIdeaResponse($exception, $exception->getMessage(), true);
        }


    }
}