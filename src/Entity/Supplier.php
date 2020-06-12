<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Supplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRegistration;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSupply;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Supplier
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateRegistration(): ?\DateTimeInterface
    {
        return $this->dateRegistration;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateSupply(): ?\DateTimeInterface
    {
        return $this->dateSupply;
    }

    /**
     * @param \DateTimeInterface|null $dateSupply
     * @return Supplier
     */
    public function setDateSupply(?\DateTimeInterface $dateSupply): self
    {
        $this->dateSupply = $dateSupply;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        $this->dateRegistration = new \DateTime("now");
    }
}
