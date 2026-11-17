<?php

namespace iutnc\minideefy\action;

use Exception;
use iutnc\minideefy\render\RendererFactory;
use iutnc\minideefy\render\Renderer;
use iutnc\minideefy\audio\tracks\PodcastTrack;
use iutnc\minideefy\audio\lists\PlaylistList;

// Ajouter 1 track dans la playlist
class AddPodcastTrackAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function methodeGet(): string
    {
        if (isset($_SESSION['Playlist'])) {
            return <<< HTML
            <form method="post" action="?action=add-track" enctype="multipart/form-data">
            <label for="titre"> Titre : </label>
            <input type='text' name="titre" id="titre" required>
            <label for="chemin"> Chemin : </label>
            <input type="file" name="userfile">
            <button type="submit"> Créer </button>
            </form>
HTML;
        } else {
            return "<p>Impossible d'accéder à playlist</p>";
        }
    }

    public function methodePost(): string
    {
        if ($_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
            if (substr($_FILES['userfile']['name'], -4) === '.mp3') {
                if ($_FILES['userfile']['type'] === 'audio/mpeg') {
                    $titre = filter_var($_POST['titre'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $nom = uniqid(); // Nom généré aléatoirement
                    move_uploaded_file($_FILES['userfile']['tmp_name'], "audio/" . $nom .".mp3");
                    $pod = new PodcastTrack($titre, "audio/" . $nom .".mp3");
                    $pl = $_SESSION['Playlist'];
                    $pl->ajouterPiste($pod);
                    $_SESSION['Playlist'] = $pl;
                    $render = RendererFactory::getRenderer($pl);
                    $retour = $render->render();
                    $retour .= '<a href="?action=add-track">Ajouter encore une piste</a>';
                    return $retour;
                } else {
                    throw new Exception("Le type doit être audio/mpeg");
                }
            } else {
                throw new Exception("L'extension du fichier doit être .mp3");
            }
        } else {
            throw new Exception("Bug d'upload");
        }
    }
}
