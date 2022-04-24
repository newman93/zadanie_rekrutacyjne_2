<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
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
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Zamowienie::class, mappedBy="status")
     */
    private $zamowienies;

    public function __construct()
    {
        $this->zamowienies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Zamowienie>
     */
    public function getZamowienies(): Collection
    {
        return $this->zamowienies;
    }

    public function addZamowieny(Zamowienie $zamowieny): self
    {
        if (!$this->zamowienies->contains($zamowieny)) {
            $this->zamowienies[] = $zamowieny;
            $zamowieny->setStatus($this);
        }

        return $this;
    }

    public function removeZamowieny(Zamowienie $zamowieny): self
    {
        if ($this->zamowienies->removeElement($zamowieny)) {
            // set the owning side to null (unless already changed)
            if ($zamowieny->getStatus() === $this) {
                $zamowieny->setStatus(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->status;
    }
}
