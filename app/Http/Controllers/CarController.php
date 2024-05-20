<?php
namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Mf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**x`
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = car::paginate(10);
        return view('car.car-list',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mfs=Mf::all();
        return view('car.car-create',compact('mfs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "produced_on"  => "required|date",
            "mf_id" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()){
            return redirect('cars/create')->withErrors($validation)->withInput();
        }
       
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
     
        $car=new Car();
        $car->description=$request->input('description');
        $car->model=$request->input('model');
        $car->produced_on=$request->input('produced_on');
        $car->mf_id=$request->input('mf_id');
        $car->image=$name;
        $car->save();
        return redirect('cars')->with('message','Thêm xe thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return view('car.car-show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car=Car::find($id);
        $mf=Mf::all();
        return view('car.car-edit',compact('car','mf'));
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
        $validation = Validator::make($request->all(), [
        "description" => "required",
        "model" => "required",
        "produced_on" => "required|date",
        "mf_id" => "required",
        'image_file' => 'mimes:jpeg,jpg,png,gif|max:10000000'
    ]);

    if ($validation->fails()) {
        return redirect()->back()->withErrors($validation)->withInput();
    }

    $car = Car::find($id);

    $car->description = $request->input('description');
    $car->model = $request->input('model');
    $car->produced_on = $request->input('produced_on');
    $car->mf_id = $request->input('mf_id');

    if ($request->hasFile('image_file')) {
        $file = $request->file('image_file');
        $name = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('image');
        $file->move($destinationPath, $name);
        $car->image = $name;
    }

    $car->save();

    return redirect('cars')->with('message', 'Cập nhật thông tin xe thành công');
}
  

    public function destroy($id)
    {
        $car = Car::find($id);
        $linkImage=public_path('image/').$car->image;
        if(File::exists($linkImage)){   
            File::delete($linkImage);
        }
        $car->delete();
        return redirect()->back()->with('message','Bạn đã xoá thành công');
        
    }
    public function postSearch(Request $req){
        $search_value=$req->txtSearch;
        $cars_search=Car::where('model','like','%'.$search_value)->orWhere('description','like','%'.$search_value.'%')->PAGINATE(3);
        return view('car.car-list',compact('cars_search'));
    }
}
