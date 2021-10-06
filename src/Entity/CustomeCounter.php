<?php

namespace App\Entity;

use App\Repository\CustomeCounterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CustomeCounterRepository::class)
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="CustomeCounter:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="CustomeCounter:item"}}},
 *     paginationEnabled=false
 * )
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
        #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]   
      */
    private $user;

    /**
     * @ORM\Column(type="string", length=300, unique=true)
     #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=300,nullable=false)
       #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=300,nullable=true)
       #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $textFirst;

    /**
     * @ORM\Column(type="string", length=300,nullable=true)
       #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $textLast;

    /**
     * @ORM\Column(type="string", length=300,options={"default" : 0})
       #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $likeCount;

    /**
     * @ORM\Column(type="datetime",nullable=false,type="string",length=300)
       #[Groups(['CustomeCounter:list', 'CustomeCounter:item'])]
     */
    private $dateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
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
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime): void
    {
        $this->dateTime = $dateTime;
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
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param mixed $likeCount
     */
    public function setLikeCount($likeCount): void
    {
        $this->likeCount = $likeCount;
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
