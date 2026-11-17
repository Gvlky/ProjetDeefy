<?php
// Charger l'autoloader
require_once "../vendor/autoload.php";

// Importations via l'autoloader
use iutnc\minideefy\dispatch\Dispatcher;
use iutnc\minideefy\action\DefaultAction;
use iutnc\minideefy\action\AddPlaylistAction;
use iutnc\minideefy\action\AddPodcastTrackAction;
use iutnc\minideefy\action\AddUserAction;
use iutnc\minideefy\action\DisplayPlaylistAction;
use iutnc\minideefy\repository\DeefyRepository;


// Connexion avec la base de données
DeefyRepository::setConfig(__DIR__ . "/../config/deefy.db.ini");

// Dispatcher
$dispatcher = new Dispatcher();

// Routes
$dispatcher
    ->addRoute("default", DefaultAction::class)
    ->addRoute("add-playlist", AddPlaylistAction::class)
    ->addRoute("add-track", AddPodcastTrackAction::class)
    ->addRoute("add-user", AddUserAction::class)
    ->addRoute("playlists", DisplayPlaylistAction::class)
;

// Execution
session_start();
$dispatcher->run();





