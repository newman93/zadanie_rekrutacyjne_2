<?php

namespace App\Entity;

use App\Repository\ZamowienieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ZamowienieRepository::class)
 */
class Zamowienie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numer_trackingowy;

    /**
     * @ORM\Column(type="integer")
     */
    private $nadawca;

    /**
     * @ORM\Column(type="integer")
     */
    private $odbiorca;

    /**
     * @ORM\Column(type="integer")
     */
    private $zleceniodawca;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sub_nadawca;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sub_odbiorca;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sub_zleceniodawca;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="zamowienies")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerTrackingowy(): ?string
    {
        return $this->numer_trackingowy;
    }

    public function setNumerTrackingowy(string $numer_trackingowy): self
    {
        $this->numer_trackingowy = $numer_trackingowy;

        return $this;
    }

    public function getNadawca(): ?int
    {
        return $this->nadawca;
    }

    public function setNadawca(int $nadawca): self
    {
        $this->nadawca = $nadawca;

        return $this;
    }

    public function getOdbiorca(): ?int
    {
        return $this->odbiorca;
    }

    public function setOdbiorca(int $odbiorca): self
    {
        $this->odbiorca = $odbiorca;

        return $this;
    }

    public function getZleceniodawca(): ?int
    {
        return $this->zleceniodawca;
    }

    public function setZleceniodawca(int $zleceniodawca): self
    {
        $this->zleceniodawca = $zleceniodawca;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getSubNadawca(): ?bool
    {
        return $this->sub_nadawca;
    }

    public function setSubNadawca(bool $sub_nadawca): self
    {
        $this->sub_nadawca = $sub_nadawca;

        return $this;
    }

    public function getSubOdbiorca(): ?bool
    {
        return $this->sub_odbiorca;
    }

    public function setSubOdbiorca(bool $sub_odbiorca): self
    {
        $this->sub_odbiorca = $sub_odbiorca;

        return $this;
    }

    public function getSubZleceniodawca(): ?bool
    {
        return $this->sub_zleceniodawca;
    }

    public function setSubZleceniodawca(bool $sub_zleceniodawca): self
    {
        $this->sub_zleceniodawca = $sub_zleceniodawca;

        return $this;
    }

    public function getStatus(): ?status
    {
        return $this->status;
    }

    public function setStatus(?status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
