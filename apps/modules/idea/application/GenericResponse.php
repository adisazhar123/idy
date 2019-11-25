<?php

namespace Idy\Idea\Application;

class GenericResponse
{
    protected $data;
    protected $message;
    protected $error;

    /**
     * GenericResponse constructor.
     * @param $data
     * @param $message
     * @param $error
     */
    public function __construct($data, $message, $error = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }


}