<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->getLatest();

        return view('category.index')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('category.form')->with([
            'edit' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        $this->categoryRepository->store($request->validated());

        return redirect()->route('category.index')
            ->withSuccess('Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $category = $this->categoryRepository->getById($id);

        return view('category.form')
            ->with([
                'category' => $category,
                'edit' => false
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getById($id);

        return view('category.form')
            ->with([
                'category' => $category,
                'edit' => true
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryCreateRequest $request, $id)
    {
        $this->categoryRepository->update($id, $request->validated());

        return redirect()->route('category.index')->withSuccess('Success Update Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryRepository->destroy($id);

        return redirect()->back()->withSuccess('Success Delete Category');
    }
}
