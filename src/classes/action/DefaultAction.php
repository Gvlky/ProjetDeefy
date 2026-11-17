<?php

namespace iutnc\minideefy\action;

class DefaultAction extends Action
{

    public function methodeGet(): string
    {
        return"<h1>Bienvenue !</h1>";
    }
    public function methodePost(): string
    {
        throw new \Exception('Not implemented');
    }
}
