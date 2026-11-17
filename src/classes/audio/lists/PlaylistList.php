<?php

namespace iutnc\minideefy\audio\lists;

use iutnc\minideefy\audio\tracks\AudioTrack;
use iutnc\minideefy\exception\InvalidPropertyNameException;

class PlaylistList extends AudioList
{
    protected ?int $id = null;
    public function __construct(string $nom, ?array $pistes)
    {
        parent::__construct($nom, $pistes);
    }

    // fonction pour ajouter une piste
    public function ajouterPiste(AudioTrack $p): void
    {
        $this->pistes[] = $p;
        $this->nbpistes++;
        $this->dureeTotale += $p->duree;
    }

    // fonction pour supprimer une piste
    // i indice ou se trouve la piste à supprimer
    public function supprimerPiste(int $i): void
    {
        $this->dureeTotale -= $this->pistes[$i]->duree;
        $this->nbpistes--;
        unset($this->pistes[$i]);
    }

    // fonction pour ajouter une liste de piste
    // lP la liste de piste qu'on veut ajouter
    public function ajouterListPiste(array $lP): void
    {
        foreach ($lP as $p) {
            if (!in_array($p, $this->pistes)) // in_array permet de vérifier que l'élément p n'est pas dans la liste "pistes"
                $this->ajouterPiste($p);
        }
    }

    // setter magique
    public function __set(string $name, mixed $value): void
    {
        // On veut pouvoir modifier que le genre
        if ($name === "id") $this->$name = $value;
        else throw new InvalidPropertyNameException("Seulement l'id peut-être modifié.");
    }
}
