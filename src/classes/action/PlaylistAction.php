<?php

namespace iutnc\minideefy\action;

use iutnc\minideefy\render\Renderer;
use iutnc\minideefy\render\RendererFactory;
use iutnc\minideefy\repository\DeefyRepository;

// Afficher la playlist en session
class PlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function methodeGet(): string
    {
        $ret = "";
        // Afficher la playlist sélectionnée
        if (array_key_exists("select", $_GET)) {
            // Récupérer la playlist séléctionnée
            $selected = $_GET["select"];
            $selected = filter_var($selected, FILTER_SANITIZE_NUMBER_INT);

            $pl = DeefyRepository::getInstance()->getPlaylist($selected);
            // Enregistrer la playlist dans la session
            $_SESSION['Playlist'] = $pl; // On pourrait mettre l'id en session aussi, c'est peut-être plus léger
            // Message de confirmation
            $ret = "<i>Vous avez sélectionné: <strong>{$pl->nom}</strong></i>";
        }
        // Afficher la playlist courante
        if (isset($_SESSION['Playlist'])) {
            $pl = $_SESSION['Playlist'];
            $renderer = RendererFactory::getRenderer($pl);
            $html = "<h3>Playlist courante :</h3>";
            $html .= $renderer->render();
            $html .= '<a href="?action=add-track">Ajouter une piste</a>';
            $ret .= $html;
        } else {
            $ret = "<p>Vous n'avez sélectionné de playlist. <a href='?action=display-playlist'>Voir les playlists</a></p>";
        }
        return $ret;
    }

    public function methodePost(): string
    {
        throw new \Exception('Not implemented');
    }
}
