<?php

namespace iutnc\deefy\render;

use InvalidArgumentException;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\AudioList;

class RendererFactory
{

    public static function getRenderer(AudioList|AudioTrack $track): Renderer
    {
        if ($track instanceof PodcastTrack) {
            return new PodcastRenderer($track);
        } else if ($track instanceof AlbumTrack) {
            return new AlbumTrackRenderer($track);
        } else if ($track instanceof AudioList) {
            return new AudioListRenderer($track);
        } else {
            throw new InvalidArgumentException("L'argument passé en paramètre doit pouvoir être affiché par un Renderer");
        }
    }
}
