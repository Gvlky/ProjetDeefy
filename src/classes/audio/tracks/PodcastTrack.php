<?php
namespace iutnc\deefy\audio\tracks;
class PodcastTrack extends AudioTrack
{
    protected ?string $auteur = null;
    protected ?string $date = null;

    public function __construct(string $titre, string $chemin)
    {
        parent::__construct($titre, null, null, null, $chemin);
    }
}
