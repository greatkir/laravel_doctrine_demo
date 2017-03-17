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
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="id")
     * @var Location
     */
    private $location_id;

    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     * @var Brand
     */
    private $brand_id;

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

    public function getContact_email()
    {
        return $this->contact_email;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation_id(): Location
    {
        return $this->location_id;
    }

    public function getBrand_id(): Brand
    {
        return $this->brand_id;
    }

    public function setContact_email($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLocation_id(Location $location_id)
    {
        $this->location_id = $location_id;
    }

    public function setBrand_id(Brand $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function getCreated_on()
    {
        return $this->created_on;
    }



}
