<?php
namespace iutnc\deefy\audio\tracks;

class AlbumTrack extends AudioTrack
{
    protected ?string $artiste = null;
    protected ?string $album = null;
    protected ?int $annee = null;
    protected int $nbpistes;

    public function __construct(string $t, string $chemin, string $nomf, int $nbpistes)
    {
        parent::__construct($t, null, null, $nomf, $chemin);
        $this->nbpistes = $nbpistes;
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }
}
