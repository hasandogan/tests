<?php

namespace App\Entity;

use App\Repository\CustomeCounterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomeCounterRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class CustomeCounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="memberId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=300, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=300,nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=300,nullable=true)
     */
    private $textFirst;

    /**
     * @ORM\Column(type="string", length=300,nullable=true)
     */
    private $textLast;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     * @Assert\Type("datetime")
     */
    private $dateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateTime(\DateTimeInterface $date): void
    {
        $this->dateTime = $date;
    }

    /**
     * @return mixed
     */
    public function getTextFirst()
    {
        return $this->textFirst;
    }

    /**
     * @param mixed $textFirst
     */
    public function setTextFirst($textFirst): void
    {
        $this->textFirst = $textFirst;
    }

    /**
     * @return mixed
     */
    public function getTextLast()
    {
        return $this->textLast;
    }

    /**
     * @param mixed $textLast
     */
    public function setTextLast($textLast): void
    {
        $this->textLast = $textLast;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }



}
