<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface RepositoryInterface {

    /**
     * Create New Entity
     *
     * @param array $entityData
     * @return Entity
     */
    public function create(array $entityData);

    /**
     * Get Entity by ID
     * @param $entity_id
     * @return Entity
     */
    public function findById($entity_id);

    /**
     * Get All objects in an Entity 
     * @return Entity List
     */
    public function findAll();
}