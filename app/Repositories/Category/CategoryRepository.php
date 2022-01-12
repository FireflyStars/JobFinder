<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Interfaces\RepositoryInterface;

/**
 * Class CategoryRepository
 * @package App\Repository
 */
class CategoryRepository implements RepositoryInterface {

    /**
     * @var Category
     */
    protected $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Create New Category
     *
     * @param array $categoryData
     * @return Category|null
     */
    public function create($categoryData)
    {
        $category = new Category();

        $category->name = trim($categoryData['name']);
        $category->active = (isset($categoryData['active']) && $categoryData['active'] == true) ? true : false;
        
        $category->save();

        return $category->fresh();
    }

    /**
     * Update Category
     *
     * @param array $categoryData
     * @return Category|null
     */
    public function update($categoryId, $categoryData)
    {
        $category = $this->findById($categoryId);

        $category->name = $categoryData['name'];
        $category->active = (isset($categoryData['active']) && $categoryData['active'] == true) ? true : false;
        
        $category->save();

        return $category->fresh();
    }

    /**
     * Get Category by ID
     *
     * @param $category_id
     * @return Category
     */
    public function findById($category_id)
    {
        return $this->category->findOrFail($category_id);
    }

    /**
     * Get Categories
     *
     * @return Category
     */
    public function findAll()
    {
        return $this->category->where('active', '=', true)->get();
    }

    /**
     * Get Categories
     *
     * @return Category
     */
    public function findAllWithoutActiveStatus()
    {
        return $this->category->orderBy('id', 'DESC')->get();
    }
}