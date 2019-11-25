<?php

namespace Idy\Idea\Domain\Model;

interface IdeaRepository
{
    public function byId(IdeaId $id);
    public function save(Idea $idea);
    public function allIdeas();
    public function allRatings();
    public function vote(Idea $idea);
    public function getRatingsByIdeaId(IdeaId $id);
    public function rate(IdeaId $id, Rating $rating);
}