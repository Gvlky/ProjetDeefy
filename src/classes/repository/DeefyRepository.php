<?php

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\tracks\AlbumTrack;
use Exception;
use PDO;
use iutnc\deefy\audio\lists\PlaylistList;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class DeefyRepository
{
    private static array $config;
    private PDO $bd;
    private static ?DeefyRepository $repo = null;

    private function __construct()
    {
        $dsn = self::$config['driver'] . ":host=" . self::$config['host'] . ";dbname=" . self::$config['database'];
        $this->bd = new PDO($dsn, self::$config['username'], self::$config['password'], [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
        ]);
    }

    public static function setConfig($file)
    {
        if (file_exists($file)) {
            self::$config = parse_ini_file($file);
        } else {
            throw new Exception("Le nom de fichier ne fonctionne pas");
        }
    }

    public static function getInstance(): DeefyRepository
    {
        if (self::$repo === null) {
            self::$repo = new DeefyRepository();
        }
        return self::$repo;
    }

    // recuperer la liste des playlists
    public function findAllPlayLists(): array
    {
        $query = "Select * from playlist";
        $stmt = $this->bd->prepare($query);
        $listPl = $stmt->execute();

        // récupérer les informations de la requête
        $playlist = [];
        while ($l = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pl = new PlaylistList($l['nom'], null);
            $pl->id = $l['id'];
            $playlist[] = $pl;
        }
        return $playlist;
    }

    // Sauvegarder une plalyslist vide de piste
    public function saveEmptyPlayList(PlaylistList $pl): PlaylistList
    {
        $query = "insert into playlist (nom) values (?)";
        $stmt = $this->bd->prepare($query);
        $stmt->execute([$pl->nom]);
        $pl->id = $this->bd->lastInsertId();
        return $pl;
    }

    // Sauvegarder une piste
    public function savePodcastTrack(AudioTrack $track): AudioTrack
    {
        // j'ai remarqué seulement après qu'il fallait gérer les podcast si jamais cela peut-être utile je laisse ça là
        if ($track instanceof AlbumTrack) {
            $query = "insert into track (titre,genre,duree,filename,type,artiste_album,annee_album,numero_album) values (?,?,?,?,?,?,?,?)";
            $stmt = $this->bd->prepare($query);
            $stmt->execute([$track->titre, AudioTrack::getGenreAsString($track->genre), $track->duree, $track->chemin, 'A', $track->artiste, $track->annee, 1]);
        }

        if ($track instanceof PodcastTrack) {
            $query = "insert into track (titre,genre,filename,type,auteur_podcast,date_posdcast) values(?,?,?,?,?,?)";
            $stmt = $this->bd->prepare($query);
            $stmt->execute([$track->titre, 'docu', $track->chemin, 'P', $track->auteur, $track->date]);
        }
        $track->id = $this->bd->lastInsertId();
        return $track;
    }

    // ajouter une piste existante à une playlist existante
    public function addTrackToPlaylist(int $idPl, int $idTrack): void
    {
        // pour avoir le n° dans la liste
        $queryNum = "select MAX(no_piste_dans_liste) as max from playlist2track where id_pl=?";
        $stmtNum = $this->bd->prepare($queryNum);
        $stmtNum->execute([$idPl]);
        $result = $stmtNum->fetch(PDO::FETCH_ASSOC);
        $noP = ($result['max'] ?? 0) +1;


        $query = "insert into playlist2track (id_pl, id_track, no_piste_dans_liste) values(?,?,?)";
        $stmt = $this->bd->prepare($query);
        $stmt->execute([$idPl, $idTrack, $noP]);
    }
}
