<?php

namespace Idy\Idea\Application;

use Idy\Idea\Domain\Model\IdeaRepository;

class ViewAllIdeasService
{
    protected $repository;

    public function __construct(IdeaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle()
    {
        $ideas = $this->repository->allIdeas();
        $ratings = $this->repository->allRatings();
        $mapperResponse = new IdeaMapper($ideas, $ratings);

        return $mapperResponse;
    }
}