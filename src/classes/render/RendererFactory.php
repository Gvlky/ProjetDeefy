<?php

namespace iutnc\minideefy\render;

use InvalidArgumentException;
use iutnc\minideefy\audio\tracks\AudioTrack;
use iutnc\minideefy\audio\tracks\AlbumTrack;
use iutnc\minideefy\audio\tracks\PodcastTrack;
use iutnc\minideefy\audio\lists\AudioList;

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
