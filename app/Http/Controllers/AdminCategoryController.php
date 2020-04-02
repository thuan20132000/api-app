<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::paginate(20);
        return view('pages.category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.category.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



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


            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name,'-');
            $category->imageUrl = $imageUrl;
            $category->status = $request->status;

            $category->save();

            return redirect()->back()->with('message',"Created Successful");



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
        $category = Category::find($id);

        return response()->json([
            'data'=>$category,
        ]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);

        $category->update($request->all());
        return response()->json([
            'state'=>$request->all()
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
        $category = Category::find($id);

        $category->delete();

        return response()->json([
            'state'=>204
        ]);

    }
}
