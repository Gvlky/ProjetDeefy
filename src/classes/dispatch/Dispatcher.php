<?php

namespace iutnc\minideefy\dispatch;

use iutnc\minideefy\action\DefaultAction;
use iutnc\minideefy\action\AddPlaylistAction;
use iutnc\minideefy\action\AddPodcastTrackAction;
use iutnc\minideefy\action\DisplayListPlaylistBDDAction;
use iutnc\minideefy\action\DisplayPlaylistAction;
use iutnc\minideefy\action\AddUserAction;

class Dispatcher
{
    private string $action;
    private array $routes;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
        $this->routes = [];
    }

    public function run(): void
    {
        $class = $this->routes[$this->action] ?? DefaultAction::class;
        $action = new $class();
        $this->renderPage($action->execute());
    }

    public function addRoute(string $action, string $class): self
    {
        if (!array_key_exists($action, $this->routes)) {
            $this->routes[$action] = $class;
        }
        return $this;
    }

    private function renderPage(string $html): void
    {
        // Document complet html
        echo <<<HTML
<!DOCTYPE html> 
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Mini Deefy</title>
</head>
<body>
    <header>
        <h1>Mini Deefy</h1>
        <nav>
            <ul>
                <li><a href="?action=default">Accueil</a></li>
                <li><a href="?action=add-user">Inscription</a></li>
                <li><a href="?action=display-playlist">Afficher les playlists</a></li>
                <li><a href="?action=playlist">Afficher la playlist courante</a></li>
                <li><a href="?action=add-playlist">Créer une playlist</a></li>            
            </ul>
        </nav>
    </header> 
    <main>
        $html
    </main>
    <footer>
        <p>Projet réalisé par Aaron B et Antonin G - S3B</p>
    </footer>
</body>
</html>
HTML;
    }
}
