<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Get api categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return $this->showAll($categories, Response::HTTP_OK);
    }
}
