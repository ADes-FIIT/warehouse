<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Movement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Item")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @var Supplier
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier")
     * @ORM\JoinColumn(nullable=true)
     */
    private $supplier;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $direction;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateWhen;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Item|null
     */
    public function getItem(): ?Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return Movement
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @param Supplier $supplier
     * @return Movement
     */
    public function setSupplier(Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return int
     */
    public function getDirection(): ?int
    {
        return $this->direction;
    }

    /**
     * @param int $direction
     * @return Movement
     */
    public function setDirection(int $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->dateWhen = new \DateTime("now");
    }
}
