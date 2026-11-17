<?php
namespace iutnc\minideefy\audio\lists;
use iutnc\minideefy\exception\InvalidPropertyValueException;


class AlbumList extends AudioList
{
    private String $nomArtiste;
    private String $date;
    public function __construct(String $nom, ?array $pistes, String $nomArtiste, String $date)
    {
        if ($pistes === null) throw new InvalidPropertyValueException("La liste ne doit pas être vide");
        parent::__construct($nom, $pistes);
        $this->nomArtiste = $nomArtiste;
        $this->date = $date;
    }

    // fonction pour mettre à jour l'artiste
    public function setArtiste(String $nom): void
    {
        $this->nomArtiste = $nom;
    }

    // fonction pour mettre à jour la date de sortie
    public function setDate(String $date): void
    {
        $this->date = $date;
    }
}
