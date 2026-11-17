<?php

namespace iutnc\deefy\audio\lists;

use Iterator;
use iutnc\deefy\exception\InvalidPropertyNameException;

class AudioList implements Iterator
{

    protected string $nom;
    protected int $nbpistes;
    protected int $dureeTotale;
    protected array $pistes;

    // Attribut pour Iterator
    protected int $position; // savoir à quelle valeur on est


    public function __construct(string $nom, ?array $pistes)
    {
        $this->nom = $nom;

        // pour gérer les pistes
        if ($pistes === null) {
            $this->pistes = [];
        } else {
            $this->pistes = $pistes;
        }

        // nombre de pistes
        $this->nbpistes = count($this->pistes);

        // calculer la durée totale
        $total = 0;
        foreach ($this->pistes as $p) {
            $total += $p->duree;
        }
        $this->dureeTotale = $total;

        // Pour faire fonctionner Iterator
        $this->position = 0;
    }


    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) return $this->$at;
        throw new InvalidPropertyNameException("invalid property : $at"); // Si l'nattribut n'existe pas
        // <> sans car sinon ça ne s'affiche pas sur le navigateur
    }

    // Méthodes Iterator

    // Pour avoir la valeur courante
    public function current(): mixed
    {
        return $this->pistes[$this->position];
    }

    // Pour avoir la clé
    public function key(): mixed
    {
        return $this->position;
    }

    // Passer à la piste suivante
    public function next(): void
    {
        $this->position++;
    }

    // Replacer le curseur au début
    public function rewind(): void
    {
        $this->position = 0;
    }
    
    // retourne vrai si il y a encore des éléments dans la liste
    public function valid(): bool
    {
        return isset($this->pistes[$this->position]);
    }
}
