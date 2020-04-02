<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Model\Category;
use App\Model\Colors;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Sizes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        $colors = Colors::all();
        $sizes = Sizes::all();
        $products = Product::all();

        return view('pages.product.index',['products'=>$products,'colors'=>$colors,'categories'=>$categories,'sizes'=>$sizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sizes = Sizes::all();
        $colors = Colors::all();
        $categories = Category::all();
        return view('pages.product.create',['categories'=>$categories,'sizes'=>$sizes,'colors'=>$colors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->flash();

        $validatorData = Validator::make($request->all(),[
            'name'=>'required',
            'price'=>"required|numeric",
            'stock'=>'required|numeric',
            'discount'=>'numeric',
            'category_id'=>'required'
        ], [
            'name.required'=>"name was empty",
            'price.required'=>'price was empty',
            'price.numeric'=>'price have to be a number',
            'stock.required'=>'stock was empty',
            'stock.numeric'=>'stock have to be a number',
            'discount.numeric'=>'discount have to be number',
            'category_id'=>'category was empty ',


        ]);



        if($validatorData->fails()){
            return redirect()->back()->withErrors($validatorData->errors());
        }


        //
        if ($request->file('image')) {
			// File này có thực, bắt đầu đổi tên và move
			$fileExtension = $request->file('image')->getClientOriginalExtension(); // Lấy . của file

			// Filename cực shock để khỏi bị trùng
			$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;

			// Thư mục upload
			$uploadPath = public_path('/upload/image'); // Thư mục upload

			// Bắt đầu chuyển file vào thư mục
			$request->file('image')->move($uploadPath, $fileName);
            $imageUrl = url('/upload/image')."/".$fileName;

			// Thành công, show thành công
		}
		else {
			// Lỗi file
			return redirect()->back()->with('message', 'Upload Failed');
        }


        $product = new Product;
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name,'-');
        $product->detail = $request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->imageUrl = $imageUrl;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->status = $request->status;


        $product->save();

        return redirect()->back()->with('message','created successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $product = Product::find($id);
        // return response()->json([
        //     'data'=>$product
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);


        return response()->json([
            'data'=>$product
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        return response()->json([
            'data'=>$request->all()
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

            $product = Product::find($id);
            $product->delete();

            return response()->json([
                'state'=>204
            ]);


    }
}
