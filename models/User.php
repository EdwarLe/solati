<?php
class User
{
    private $id;
    private $email;
    private $name;
    private $surname;
    private $job;
    private $password;

    public function __construct($id, $email, $name, $surname, $job, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->job = $job;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getJob()
    {
        return $this->job;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
