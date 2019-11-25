<?php

namespace Idy\Idea\Domain\Model;

use Idy\Common\Events\DomainEventPublisher;

class Idea
{
    private $id;
    private $title;
    private $description;
    private $author;
    private $ratings;
    private $votes;

    const INIT_VOTE = 0;
    const INIT_RATINGS = [];

    public function __construct(IdeaId $id, $title, $description, $votes, array $ratings, Author $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->votes = $votes;

        if (! $ratings) {
            $this->ratings = $ratings;
        } else {
            foreach ($ratings as $rating)
            {
                $this->ratings[] = new Rating($rating['name'], $rating['value']);
            }
        }

    }

    public function appendRating($rating)
    {
        $this->ratings[] = $rating;
    }

    public function id() 
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function author()
    {
        return $this->author;
    }

    public function votes()
    {
        return $this->votes;
    }

    public function addRating($user, $ratingValue)
    {
        $newRating = new Rating($user, $ratingValue);

        if ($newRating->isValid()) {
            $exist = false;
            foreach ($this->ratings as $existingRating) {
                if ($existingRating->equals($newRating)) {
                    $exist = true;
                }
            }

            if (!$exist) {
                array_push($this->ratings, $newRating);
            } else {
                throw new Exception('Author ' . $newRating->author() . ' has given a rating.');
            }

            DomainEventPublisher::instance()->publish(
                new IdeaRated($this->author->name(), $this->author->email(), 
                    $this->title, $ratingValue)
            );

            return $newRating;
        }
    }

    public function vote()
    {   
        $this->votes = $this->votes + 1;
    }

    public function averageRating()
    {
        $numberOfRatings = count($this->ratings);
        if (! $numberOfRatings) return 0;

        $totalRatings = 0;

        foreach ($this->ratings as $rating) {
            $totalRatings += $rating->value();
        }

        return $totalRatings / $numberOfRatings;
    }

    public static function makeIdea($title, $description, $votes, $author)
    {
        $newIdea = new Idea(new IdeaId(), $title, $description, $votes, self::INIT_RATINGS, $author);
        
        return $newIdea;
    }

    public function numberOfRatings()
    {
        return count($this->ratings);
    }

}