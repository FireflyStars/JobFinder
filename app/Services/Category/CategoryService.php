<?php
namespace App\Services\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;

/**
 * Class CategoryService
 * @package App\Services\Category
 */
class CategoryService {

    protected $categoryRepository;

    /**
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * Get Category by ID
     *
     * @param $category_id
     * @return Category
     */
    public function find($category_id)
    {
        try {
            return $this->categoryRepository->findById($category_id);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get All Companies
     *
     * @return Category
     */
    public function findAll()
    {
        try {
            return $this->categoryRepository->findAll();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Get All Categories without active status
     *
     * @return Category
     */
    public function findAllWithoutActiveStatus()
    {
        try {
            return $this->categoryRepository->findAllWithoutActiveStatus();
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Create New Category
     *
     * @param array $categoryData
     * @return Category|null
     */
    public function create($categoryData)
    {
        try {
            return $this->categoryRepository->create($categoryData);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }

    /**
     * Update Category
     * 
     * @param int $id
     * @param array $categoryData
     * @return Category|null
     */
    public function update($id, $categoryData)
    {
        try {
            return $this->categoryRepository->update($id, $categoryData);
        } catch (\Exception $e) {
            dd('error', $e);
            return null;
        }
    }
}