<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $note = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'note')]
    private Collection $id_eleve;

    /**
     * @var Collection<int, Matiere>
     */
    #[ORM\OneToMany(targetEntity: Matiere::class, mappedBy: 'note')]
    private Collection $id_matiere;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseignant $enseignant_id = null;

    public function __construct()
    {
        $this->id_eleve = new ArrayCollection();
        $this->id_matiere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): static
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getIdEleve(): Collection
    {
        return $this->id_eleve;
    }

    public function addIdEleve(Eleve $idEleve): static
    {
        if (!$this->id_eleve->contains($idEleve)) {
            $this->id_eleve->add($idEleve);
            $idEleve->setNote($this);
        }

        return $this;
    }

    public function removeIdEleve(Eleve $idEleve): static
    {
        if ($this->id_eleve->removeElement($idEleve)) {
            // set the owning side to null (unless already changed)
            if ($idEleve->getNote() === $this) {
                $idEleve->setNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getIdMatiere(): Collection
    {
        return $this->id_matiere;
    }

    public function addIdMatiere(Matiere $idMatiere): static
    {
        if (!$this->id_matiere->contains($idMatiere)) {
            $this->id_matiere->add($idMatiere);
            $idMatiere->setNote($this);
        }

        return $this;
    }

    public function removeIdMatiere(Matiere $idMatiere): static
    {
        if ($this->id_matiere->removeElement($idMatiere)) {
            // set the owning side to null (unless already changed)
            if ($idMatiere->getNote() === $this) {
                $idMatiere->setNote(null);
            }
        }

        return $this;
    }

    public function getEnseignantId(): ?Enseignant
    {
        return $this->enseignant_id;
    }

    public function setEnseignantId(?Enseignant $enseignant_id): static
    {
        $this->enseignant_id = $enseignant_id;

        return $this;
    }
}
