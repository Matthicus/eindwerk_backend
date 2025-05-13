<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
class CategorieController
{
    public function index()
    {
        try {
            $categories = Categories::all(); // Fetch all categories
            return response()->json($categories);
        } catch (\Exception $e) {
            // If an error occurs, return a 500 response with error details
            return response()->json([
                'error' => 'Failed to fetch categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}