<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Get api limit categories
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = new Category;
        if ($request->has('limit')) {
            $categories = $categories->limitCategory($request->limit);
        }
        $categories = $categories->get();
        return $this->showAll($categories, Response::HTTP_OK);
    }
}
