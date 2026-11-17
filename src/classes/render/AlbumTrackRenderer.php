<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;

class AlbumTrackRenderer extends AudioTrackRenderer
{
    private AlbumTrack $album;

    public function __construct(AlbumTrack $album)
    {
        $this->album = $album;
    }

    // affichage compact
    protected function renderCompact(): string
    {
        $html = "<ol>";
        $html .= "<li>Titre : {$this->album->titre}</li>";
        $html .= "<li>Nom audio : {$this->album->nomf}</li>";
        $html .= "<li>Artiste : {$this->album->artiste}</li>";
        $html .= "<li>Album : {$this->album->album}</li>";
        $html .= "<li>Nombre de pistes : {$this->album->nbpistes}</li>";
        $html .= "<li>Genre : " . AlbumTrack::getGenreAsString($this->album->genre) . "</li>";
        $html .= "<li>Durée : {$this->album->duree} s</li>";
        $html .= "<li>Année : {$this->album->annee}</li>";
        $html .= "<li>Chemin: {$this->album->chemin}</li>";
        $html .= "</ol>";
        $html .= "<audio src='{$this->album->chemin}'></audio>";
        return $html;
    }

    // affichage long
    protected function renderLong(): string
    {
        $html = "<p> Titre : {$this->album->titre}, 
        Nom audio : {$this->album->nomf}, 
        Artiste : {$this->album->artiste}, 
        Album : {$this->album->album}, 
        Nombre de pistes : {$this->album->nbpistes}, 
        Genre : " . AlbumTrack::getGenreAsString($this->album->genre) . ", 
        Durée : {$this->album->duree} s, 
        Année : {$this->album->annee}, 
        Chemin: {$this->album->chemin}</p>";
        $html .= "<audio src='{$this->album->chemin}'></audio>";
        return $html;
    }

    public function __set(string $at, AlbumTrack $al): void
    {
        $this->$at = $al;
    }
}
