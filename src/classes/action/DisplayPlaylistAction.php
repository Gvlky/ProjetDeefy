<?php

namespace iutnc\deefy\action;

use iutnc\deefy\render\RendererFactory;

// Afficher la playlist en session
class DisplayPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function methodeGet(): string
    {
        if (isset($_SESSION['playlist'])) {
            $pl = $_SESSION['playlist'];
            $renderer = RendererFactory::getRenderer($pl);
            return $renderer->render();
        } else {
            return "<p>Impossible d'accéder à playlist</p>";
        }
    }

    public function methodePost(): string
    {
        throw new \Exception('Not implemented');
    }
}
