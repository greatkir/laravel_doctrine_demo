<?php

namespace App;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Jobs")
 */
class Job
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     *
     * @ORM\Column(type="string");
     */
    private $contact_email;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Location")
     *
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     *
     */
    private $brand;

    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $created_on;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->contact_email;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setEmail($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLocation(Location $location_id)
    {
        $this->location_id = $location_id;
    }

    public function setBrand(Brand $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function getCreatedTime()
    {
        return $this->created_on;
    }

    public function setCreatedTime($created_on)
    {
        $this->created_on = $created_on;
    }
}
