<?php

namespace iutnc\minideefy\action;

use iutnc\minideefy\render\RendererFactory;

// Afficher la playlist en session
class DisplayPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function methodeGet(): string
    {
        if (isset($_SESSION['Playlist'])) {
            $pl = $_SESSION['Playlist'];
            $renderer = RendererFactory::getRenderer($pl);
            $html = $renderer->render();
            $html .= '<a href="?action=add-track">Ajouter une piste</a>';
            return $html;
        } else {
            return "<p>Impossible d'accéder à playlist</p>";
        }
    }

    public function methodePost(): string
    {
        throw new \Exception('Not implemented');
    }
}
