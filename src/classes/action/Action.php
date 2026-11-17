<?php

namespace iutnc\minideefy\action;

use Exception;

abstract class Action
{
    protected ?string $http_method = null;
    protected ?string $hostname    = null;
    protected ?string $script_name = null;

    public function __construct()
    {
        $this->http_method = $_SERVER['REQUEST_METHOD']; // attribut http-request, je ne modifie pas le nom car c'est comme ça que la classe a été donnée
        $this->hostname    = $_SERVER['HTTP_HOST'];
        $this->script_name = $_SERVER['SCRIPT_NAME'];
    }

    public function execute(): string
    {
        if ($this->http_method === 'GET') {
            return $this->methodeGet();
        } else if ($this->http_method === 'POST') {
            return $this->methodePost();
        } else {
            throw new \Exception("Traitement de la méthode non implémentée");
        }
    }

    public abstract function methodeGet(): string;

    public abstract function methodePost(): string;
}
