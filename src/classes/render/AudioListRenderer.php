<?php

namespace iutnc\deefy\render;
use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer implements Renderer
{
    private AudioList $al;

    public function __construct(AudioList $al)
    {
        $this->al = $al;
    }

    // permet d'afficher les playlist
    public function render(?int $selector = null): string
    {
        $s = "Nom de la playlist : " . $this->al->nom . "<br>";
        foreach ($this->al->pistes as $piste) {
            $trackRenderer = RendererFactory::getRenderer($piste);
            $s = $s . $trackRenderer->render(Renderer::COMPACT);
        }

        $s = $s . "Nombre de pistes : " . $this->al->nbpistes . "<br>";
        $s = $s . "Durée totale : " . $this->al->dureeTotale . "<br>";
        return $s;
    }
}
