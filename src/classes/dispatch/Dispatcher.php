<?php

namespace iutnc\minideefy\dispatch;

use iutnc\minideefy\action\AddPlaylistAction;
use iutnc\minideefy\action\AddPodcastTrackAction;
use iutnc\minideefy\action\DefaultAction;
use iutnc\minideefy\action\DisplayPlaylistAction;
use iutnc\minideefy\action\AddUserAction;

class Dispatcher
{
    private string $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function run(): void
    {
        $resultat = "";
        switch ($this->action) {
            case "default":
                $d = new DefaultAction();
                $resultat = $d();
                break;
            case "playlist":
                $pl = new DisplayPlaylistAction();
                $resultat = $pl();
                break;
            case "add-playlist":
                $addPl = new AddPlaylistAction();
                $resultat = $addPl();
                break;
            case "add-track":
                $addT = new AddPodcastTrackAction();
                $resultat = $addT();
                break;
            case "add-user":
                $addU = new AddUserAction();
                $resultat = $addU();
                break;
        }
        $this->renderPage($resultat);
    }

    private function renderPage(string $html): void
    {
        // Document complet html
        echo <<<HTML
        <!DOCTYPE html> 
        <html lang='fr'>
        <head>
        <meta charset='UTF-8'>
        <title>Deefy</title>
        </head>
        <body>
            <h1>Deefy</h1>
            <nav><ul>
                <li><a href="?action=default">Accueil</a></li>
                <li><a href="?action=add-user">Inscription</a></li>
                <li><a href="?action=add-playlist">Créer une playlist</a></li>
            </ul></nav>
        $html
        </body>
        </html>
HTML;
    }
}
