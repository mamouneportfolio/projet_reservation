<?php
namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service {
    #[ORM\Id] #[ORM\GeneratedValue] #[ORM\Column]
    #[Groups(['service:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['service:read'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['service:read'])]
    private ?float $price = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getPrice(): ?float { return $this->price; }
    public function setPrice(float $price): self { $this->price = $price; return $this; }
}
