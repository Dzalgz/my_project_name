<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Serializer\Annotation\Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     */
    private $product_type;

    /**
     * @ORM\Column(type="integer")
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/[1-9]/", message="invalid format")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", options={"default" : "Новый"})
     * @JMS\Serializer\Annotation\Type("string")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Buyer", inversedBy="products")
     * @ORM\JoinColumn(name="buyer_id", referencedColumnName="id")
     * @JMS\Serializer\Annotation\Type("App\Entity\Buyer")
     */
    private $buyer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductType(): ?string
    {
        return $this->product_type;
    }

    public function setProductType(string $product_type): self
    {
        $this->product_type = $product_type;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
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
     * Set buyer
     *
     * @param \App\Entity\Buyer $buyer
     *
     * @return Product
     */
    public function setBuyer(Buyer $buyer = null)
    {
        $this->buyer = $buyer;

        return $this;
    }
    /**
     * Get buyer
     *
     * @return \App\Entity\Buyer
     */
    public function getBuyer()
    {
        return $this->buyer;
    }
}
