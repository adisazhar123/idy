<?php

namespace Idy\Idea\Application;

class RateIdeaResponse extends GenericResponse
{
    public function __construct($data, $message, $error = null)
    {
        parent::__construct($data, $message, $error);
    }
}