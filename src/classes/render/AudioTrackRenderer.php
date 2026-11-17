<?php
namespace iutnc\deefy\render;
abstract class AudioTrackRenderer implements Renderer
{
    public function render(int $selector): string
    {
        if ($selector === Renderer::COMPACT) {
            return $this->renderCompact();
        } else {
            return $this->renderLong();
        }
    }

    abstract protected function renderCompact(): string;
    abstract protected function renderLong(): string;
}
