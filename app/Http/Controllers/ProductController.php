namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $products = Product::all();
        $products = $products->sortByDesc('created_at');
        $products = $products->chunk(3);
        $products = $products->first();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $formTitle = "Create New Product";
        $buttonLabel = "Add Product";

        return view('products.create', compact('formTitle', 'buttonLabel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) : RedirectResponse
    {
        $validatedData = $request->all();
        $validatedData['created_at'] = now();
        $validatedData['updated_at'] = now();

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->created_at = $validatedData['created_at'];
        $product->updated_at = $validatedData['updated_at'];
        $product->save();

        return redirect()->route('products.index')
                ->with('status', 'New product is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) : View
    {
        $productDetails = [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at
        ];

        return view('products.show', compact('pro
