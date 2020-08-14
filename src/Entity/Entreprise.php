<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $num_Siret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $num_Siren;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="text")
     */
    private $activity;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSiret(): ?string
    {
        return $this->num_Siret;
    }

    public function setNumSiret(string $num_Siret): self
    {
        $this->num_Siret = $num_Siret;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumSiren(): ?string
    {
        return $this->num_Siren;
    }

    public function setNumSiren(string $num_Siren): self
    {
        $this->num_Siren = $num_Siren;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
 
}
