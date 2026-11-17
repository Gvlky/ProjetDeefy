<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AudioTrack
{
    protected string $titre;
    protected ?int $genre;
    protected ?int $duree;
    protected ?string $nomf; // nom audio
    protected string $chemin;
    protected ?int $id = null;

    // Quelques genres de musique

    // Les constantes
    public const int BLUES = 0;
    public const int JAZZ = 8;
    public const int POP = 13;
    public const int RAP = 15;
    public const int DISCO = 31;
    public const int FUNK = 32;
    public const int METAL = 36;
    public const int ROCK = 44;
    public const int TECHNO = 45;
    public const int POLKA = 75;

    // En version String avec un tableau
    private const GENRE = [
        self::BLUES => 'Blues',
        self::JAZZ => 'Jazz',
        self::POP => 'Pop',
        self::RAP => 'Rap',
        self::DISCO => 'Disco',
        self::FUNK => 'Funk',
        self::METAL => 'Metal',
        self::ROCK => 'Rock',
        self::TECHNO => 'Techno',
        self::POLKA => 'Polka'
    ];


    public function __construct(string $titre, ?int $genre, ?int $duree, ?string $nomf, string $chemin)
    {
        $this->titre = $titre;
        $this->genre = $genre;
        $this->nomf = $nomf;
        $this->chemin = $chemin;

        // Pour que la durée dépasse 0
        if ($duree < 0) {
            throw new InvalidPropertyValueException("La durée ne peut pas être négative");
        } else {
            $this->duree = $duree;
        }
    }

    // getter magique
    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) return $this->$at;
        throw new InvalidPropertyNameException("invalid property : $at"); // Si l'attribut n'existe pas
    }

    // setter magique
    public function __set(string $name, mixed $value): void
    {
        // On veut pouvoir modifier que le genre
        if ($name === "genre") $this->$name = $value;
        else if ($name === "id") $this->$name = $value;
        else throw new InvalidPropertyNameException("Seulement le genre ou l'id peuvent-être modifié.");
    }

    // Avoir le genre sous forme de string
    public static function getGenreAsString(?int $genre): string
    {
        if ($genre === null) return "";
        else
            return self::GENRE[$genre];
    }
}
