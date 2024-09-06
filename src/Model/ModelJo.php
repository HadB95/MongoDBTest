<?php

namespace App\Model;

use MongoDB\BSON\ObjectId;
use App\DAO\DAO_MongoDB;

class ModelJo
{
    private $dao;
    public function __construct()
    {
        $this->dao = new DAO_MongoDB();
    }
    public function findAll()
    {
        $collection = $this->dao->requete('athlete');
        if (!$collection) {
            return false;
        }
        try {
            $athletes = $collection->find();
            return $athletes;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function find($id)
    {
        $collection = $this->dao->requete('athlete');
        if (!$collection) {
            return false;
        }
        try {
            $athlete = $collection->findOne(['_id' => new ObjectId($id)]);
            return $athlete;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function insert($data)
    {
        unset($data['_method']);
        $collection = $this->dao->requete('athlete');
        try {
            $insertOneResult = $collection->insertOne($data);
            return $insertOneResult->getInsertedCount();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($data, $id)
    {
        unset($data['_method']);
        $collection = $this->dao->requete('athlete');
        try {
            $updateResult = $collection->updateOne(
                ['_id' => new ObjectId($id)],
                ['$set' => $data]
            );
            return $updateResult->getModifiedCount();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $collection = $this->dao->requete('athlete');
        try {
            $deleteResult = $collection->deleteOne(['_id' => new ObjectId($id)]);
            return $deleteResult->getDeletedCount();
        } catch (\Exception $e) {
            return false;
        }
    }
}
