<?php
namespace iutnc\minideefy\action;

use iutnc\minideefy\repository\DeefyRepository;

/**
 * Classe permettant d'afficher toutes les playlists de la BDD
 */

class DisplayListPlaylistBDDAction extends Action{

    public function methodeGet(): string
    {
        $repo = DeefyRepository::getInstance();
        $playlist = $repo->findAllPlayLists();
        $html = "<ul>";
        foreach ($playlist as $pl){
            $nom = filter_var($pl->nom, FILTER_SANITIZE_SPECIAL_CHARS);
            $html .= "<li><a href='?action=playlist&amp;select={$pl->id}'>$nom</a></li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function methodePost(): string
    {
        throw new \Exception('Not implemented');
    }
}