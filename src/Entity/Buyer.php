<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity
 */
class Buyer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Serializer\Annotation\Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/([а-яА-Я]+(?:. |-| |'))*[а-яА-Я]*$/", message="invalid format")
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/[1-9]{6}/", message="invalid format")
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your address must be at least 10 characters long",
     *      maxMessage = "Your address cannot be longer than 40 characters",
     *      allowEmptyString = false
     * )
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^([а-яА-Я]+(?:. |-| |'))*[а-яА-Я]*$/", message="invalid format")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/[1-9]{10}/", message="invalid format")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Serializer\Annotation\Type("string")
     * @Assert\NotBlank()
     * @Assert\Email(message = "invalid format")
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="buyer",cascade="remove")
     * @OrderBy({"id" = "DESC"})
     * @JMS\Serializer\Annotation\Type("App\Entity\Product")
     */
    private $products;


    /**
     * Buyer constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     *
     * @param \App\Entity\Product $product
     *
     * @return Buyer
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }
    /**
     * Remove product
     *
     * @param \App\Entity\Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
