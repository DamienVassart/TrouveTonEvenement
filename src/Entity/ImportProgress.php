<?php

namespace App\Entity;

use App\Repository\ImportProgressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImportProgressRepository::class)]
class ImportProgress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $importId = null;

    #[ORM\Column]
    private ?int $lastLineProcessed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImportId(): ?string
    {
        return $this->importId;
    }

    public function setImportId(string $importId): static
    {
        $this->importId = $importId;

        return $this;
    }

    public function getLastLineProcessed(): ?int
    {
        return $this->lastLineProcessed;
    }

    public function setLastLineProcessed(int $lastLineProcessed): static
    {
        $this->lastLineProcessed = $lastLineProcessed;

        return $this;
    }
}
