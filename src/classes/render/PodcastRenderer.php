<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class PodcastRenderer extends AudioTrackRenderer
{
    private PodcastTrack $podcast;

    public function __construct(PodcastTrack $podcast)
    {
        $this->podcast = $podcast;
    }

    // affichage compact
    protected function renderCompact(): string
    {
        $html = "<ol>";
        $html .= "<li>Titre : {$this->podcast->titre}</li>";
        $html .= "<li>Nom audio : {$this->podcast->nomf}</li>";
        $html .= "<li>Auteur : {$this->podcast->auteur}</li>";
        $html .= "<li>Genre : " . AudioTrack::getGenreAsString($this->podcast->genre) . "</li>";
        $html .= "<li>Durée : {$this->podcast->duree} s</li>";
        $html .= "<li>Date : {$this->podcast->date}</li>";
        $html .= "<li>Chemin: {$this->podcast->chemin}</li>";
        $html .= "</ol>";
        $html .= "<audio src='{$this->podcast->chemin}'></audio>";
        return $html;
    }

    // affichage long
    protected function renderLong(): string
    {
        $html = "<p>Titre : {$this->podcast->titre}, 
        Nom audio : {$this->podcast->nomf}, 
        Auteur : {$this->podcast->auteur}, 
        Genre : " . AudioTrack::getGenreAsString($this->podcast->genre) . ", 
        Durée : {$this->podcast->duree} s, 
        Date : {$this->podcast->date}, 
        Chemin: {$this->podcast->chemin}</p>";
        $html .= "<audio src='{$this->podcast->chemin}'></audio>";
        return $html;
    }

    public function __set(string $at, PodcastTrack $pod): void
    {
        $this->$at = $pod;
    }
}
