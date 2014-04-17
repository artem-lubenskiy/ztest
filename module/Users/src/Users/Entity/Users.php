<?php

/**
 * Description of User
 *
 * @author artem
 */

namespace Users\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Users {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /** @ORM\Column(type="string") */
    protected $firstName;
    /** @ORM\Column(type="string") */
    protected $secondName;
    /** @ORM\Column(type="string") */
    protected $patrName;
    /** @ORM\Column(type="string") */
    protected $email;
    /** @ORM\Column(type="string") */
    protected $password;
    /** @ORM\Column(type="smallint") */
    protected $typeId;
    /** @ORM\Column(type="date") */
    protected $regDate;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $patrName
     */
    public function setPatrName($patrName)
    {
        $this->patrName = $patrName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPatrName()
    {
        return $this->patrName;
    }

    /**
     * @param mixed $regDate
     */
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegDate()
    {
        return $this->regDate;
    }

    /**
     * @param mixed $secondName
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    public function addUser($data) {
        if(is_object($data)) {
            $this->firstName = $data['firstName'];
            $this->secondName = $data['secondName'];
            $this->patrName = $data['patrName'];
            $this->email = $data['email'];
            // @ToDo create Hashing
            $this->password = $data['password'];
            $this->regDate = new \DateTime("now");
            $this->typeId = 1;
            return $this;
        }
            throw new \InvalidArgumentException('Invalid input data');
    }

}
