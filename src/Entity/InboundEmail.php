<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InboundEmailRepository")
 */
class InboundEmail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $from_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $from_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $to_email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $spam_check;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromEmail(): ?string
    {
        return $this->from_email;
    }

    public function setFromEmail(string $from_email): self
    {
        $this->from_email = $from_email;

        return $this;
    }

    public function getFromName(): ?string
    {
        return $this->from_name;
    }

    public function setFromName(string $from_name): self
    {
        $this->from_name = $from_name;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->to_email;
    }

    public function setToEmail(string $to_email): self
    {
        $this->to_email = $to_email;

        return $this;
    }

    public function getSpamCheck(): ?bool
    {
        return $this->spam_check;
    }

    public function setSpamCheck(bool $spam_check): self
    {
        $this->spam_check = $spam_check;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
