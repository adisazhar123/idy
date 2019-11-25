<?php

namespace Idy\Idea\Application;

class VoteIdeaResponse extends GenericResponse
{
    public function __construct($data, $message, $error = null)
    {
        parent::__construct($data, $message, $error);
    }
}