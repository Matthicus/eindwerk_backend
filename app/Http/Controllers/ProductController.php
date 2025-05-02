<?php





namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Product API",
 *     description="API documentatie voor het beheren van producten.",
 *     @OA\Contact(
 *         email="matthice.storms@hotmail.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local development server"
 * )
 */


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   /**
 * @OA\Get(
 *     path="/api/products",
 *     summary="Get all products",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="Filter by product name",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of products"
 *     )
 * )
 */

 


    public function index(Request $request)
    {
    $query = Product::query();

    if($request->filled("name")) {
        $query->where("name", "like", "%" . $request->get("name") . "%");
    }

    $products = $query->get();
    return response()->json($products);



    }

    /**
     * Store a newly created resource in storage.
     */


  /**
 * @OA\Post(
 *     path="/api/products",
 *     summary="Create a new product",
 *     tags={"Products"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description"},
 *             @OA\Property(property="name", type="string", example="New Product"),
 *             @OA\Property(property="description", type="string", example="A cool new item")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Product created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Validation error"
 *     )
 * )
 */

    public function store(Request $request)
    {


        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string"
        ]);
        $product = Product::create([
            "name" => $validated["name"],
            "description" => $validated["description"]
        ]);



        return response() ->json($product, 201);
    }

    /**
     * Display the specified resource.
     */

     /**
 * @OA\Get(
 *     path="/api/products/{id}",
 *     summary="Get a product by ID",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product details"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */
    public function show(string $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                "error" => "Product not found"
            ],404);
        }

        return response()->json($product,200);
    }

    /**
     * Update the specified resource in storage.
     */

/**
 * @OA\Put(
 *     path="/api/products/{id}",
 *     summary="Update an existing product",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description"},
 *             @OA\Property(property="name", type="string", example="Updated Product"),
 *             @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */




    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                "error" => "Product not found"
            ],404);
        }

        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string"
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */

/**
 * @OA\Delete(
 *     path="/api/products/{id}",
 *     summary="Delete a product",
 *     tags={"Products"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Product ID",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Product not found"
 *     )
 * )
 */


    public function destroy(string $id)
    {
        $product = Product::find($id);

        if(!$product) {
            return response()->json([
                "error" => "Product not found"
            ], 404);
        }

        $product->delete();
        return response()->json(null,204);
    }
}
