<?php

namespace Deko\Model;

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $type;
    /**
     * @var \DateTime
     */
    private $lastLogin;

    /**
     * User constructor.
     * @param $id
     * @param $firstname
     * @param $lastname
     * @param $username
     * @param $type
     * @param $lastLogin
     */
    public function __construct($id, $firstname, $lastname, $username, $type, \DateTime $lastLogin)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->type = $type;
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}
