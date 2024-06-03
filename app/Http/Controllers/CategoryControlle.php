<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryControlle extends Controller
{
    public function show($id)
    {
        $products=Product::find($id);
        //tương đương select* from where
        return view('pro$product.pro$product-show',compact('pro$product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product=Product::find($id);
        return view('pro$product.pro$product-edit',compact('mfs','pro$product'));
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
        $name='';
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "product_on"  => "required|date",
            "mf_id" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
        //lấy về xe cần sửa
        $product=Product::find($id);
        if($product!=null){
            $product->description=$request->input('description');
            $product->model=$request->input('model');
            $product->product_on=$request->input('product_on');
            $product->mf_id=$request->input('mf_id');
            if($name==''){
                $name=$product->image;
            }    
            $product->image=$name;  
            $product->save();
        }
        return redirect('pro$product')->with('message','Sửa xe thành công');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
* @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        
        $linkImage=public_path('image/').$product->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $product->delete();
        return redirect()->back()->with('message', 'bạn đã xóa thành công !');
    }
}
