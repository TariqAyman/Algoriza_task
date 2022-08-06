<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->getPaginateWithSearch(10, $request);

        $categories = $this->categoryRepository->getActivePluck();

        return view('product.index')
            ->with([
                'products' => $products,
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
        $categories = $this->categoryRepository->getActivePluck();

        return view('product.form')
            ->with([
                'categories' => $categories,
                'edit' => false
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     * @return Response
     */
    public function store(ProductCreateRequest $request)
    {
        $this->productRepository->create($request);

        return redirect()->route('product.index')
            ->withSuccess('Success Created Product');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        $categories = $this->categoryRepository->getActivePluck();

        return view('product.form')
            ->with([
                'product' => $product,
                'categories' => $categories,
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
        $product = $this->productRepository->getById($id);

        $categories = $this->categoryRepository->getActivePluck();

        return view('product.form')
            ->with([
                'product' => $product,
                'categories' => $categories,
                'edit' => true
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $this->productRepository->updateWithImage($id, $request);

        return redirect()->route('product.index')
            ->withSuccess('Success Update product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->destroy($id);

        return redirect()->back()->withSuccess('Success Delete Product');
    }
}
