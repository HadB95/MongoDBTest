<?php

namespace App\DAO;

use App\System\Conf;

class DAO_MongoDB
{

    private $client;

    public function __construct()
    {
        $this->connexion();
    }
    public function connexion()
    {
        try {
            $this->client = new \MongoDB\Client(Conf::$uri);
        } catch (\Exception $e) {
            $this->client = false;
        }
    }
    public function requete($collection)
    {
        if (!$this->client) {
            return false;
        }
        return $this->client->jo2024->$collection;
    }
}
