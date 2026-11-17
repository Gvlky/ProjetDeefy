<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\PlaylistList;
use iutnc\deefy\render\RendererFactory;

// Creer 1 playlist en session
class AddPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function methodeGet(): string
    {
        return <<<HTML
        <form method="post" action="?action=add-playlist">
            <label for="nomPlaylist"> Nom de la playlist : </label>
            <input type='text' name="nomPlaylist" id="nomPlaylist" required>
            <button type="submit"> Créer </button>
        </form>
HTML;
    }

    public function methodePost(): string
    {
        $nom = filter_var($_POST['nomPlaylist'], FILTER_SANITIZE_SPECIAL_CHARS);
        $pl = new PlaylistList($nom, []);
        $_SESSION['Playlist'] = $pl;
        $render = RendererFactory::getRenderer($pl);
        $retour = $render->render();
        $retour .= '<a href="?action=add-track">Ajouter une piste</a>';
        return $retour;
    }
}
