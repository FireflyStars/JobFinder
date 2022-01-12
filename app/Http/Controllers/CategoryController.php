<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Category\CategoryService;


class CategoryController extends Controller
{
    protected $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data['categories'] = $this->categoryService->findAllWithoutActiveStatus();

        return view('admin.category.index', $data);
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store( Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:categories,name',
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $this->categoryService->create($request->all());

        session()->flash('message', 'Category has been created successfully.');
        return redirect('admin/category');
    }


    public function edit($id)
    {
        $data['categories'] = $this->categoryService->find($id);
        return view('admin.category.edit', $data);
    }


    public function update( Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:categories,name,' . $id,
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $this->categoryService->update($id, $request->all());

        session()->flash('message', 'Category has been updated successfully.');
        return redirect('admin/category');
    }


    public function destroy($id)
    {

        $category = $this->categoryService->find($id);
        if (!empty($category)) {
            $category->delete();
            session()->flash('message', 'Category has been deleted successfully.');
        } else {
            session()->flash('message', 'Somethings wents wrong');
            session()->flash('alert_tag', 'alert-danger');
        }
        return redirect('admin/category');
    }
}