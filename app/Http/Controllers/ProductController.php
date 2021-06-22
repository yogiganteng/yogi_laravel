<?php
  
namespace App\Http\Controllers;
  
use App\Models\Product;
use Illuminate\Http\Request;
  
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest('id')->paginate(5);
    
        return view('index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
 
    public function create()
    {
        return view('create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Product::create($input);
     
        return redirect('/products')
                        ->with('success','Product created successfully.');
    }
     

    public function show(Product $product)
    {
        return view('show',compact('product'));
    }
     

    public function edit(Product $product)
    {
        return view('edit',compact('product'));
    }
    

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $product->update($input);
    
        return redirect('/products')
                        ->with('success','Product updated successfully');
    }
  
    public function destroy(Product $product)
    {
        $product->delete();
     
        // return redirect()->route('index')
        return redirect('/products')
                        ->with('success','Product deleted successfully');
    }
}