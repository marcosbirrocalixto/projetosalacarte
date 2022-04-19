<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $tenantService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantFormRequest $request)
    {
        //dd($request->uuid);
        $categories = $this->categoryService->getCategoriesByUuid($request->token_company);

        return CategoryResource::collection($categories);
    }

    public function show(TenantFormRequest $request, $url)
    {
        if (!$category = $this->categoryService->getCategoryByUrl($url)) {
            return response()->json(['message' => 'Categoria não existe'], 404);
        }

        return new CategoryResource($category);
    }

}
