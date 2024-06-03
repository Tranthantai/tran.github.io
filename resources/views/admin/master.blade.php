<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cafe Amian">
    <meta name="author" content="">
    <title>Admin - Bán hàng</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('source/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('source/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('source/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('source/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ asset('source/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('source/admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div id="wrapper">
        @include('admin.header')
        @yield('content')
    </div>
    <!-- /#wrapper -->
    @yield('script')
    <!-- jQuery -->

   
   

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('source/admin/bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('source/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
   
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('source/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('source/admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <!-- <script src="{{ asset('source/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script> -->
    <!-- <script src="{{ asset('source/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script> -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <!-- <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script> -->
   
</body>

</html>

2.    Tạo model Category bằng câu lệnh:
php artisan make:model Category
Mở file app\Models\Category.php, thêm vào:
protected $table='type_products';
protected $fillable=['name','description','image'];
3.    Tạo controller CategoryController bằng câu lệnh
php artisan make:controller CategoryController
Mở CategoryController.php tạo các hàm thêm sửa xóa.
4.    Vào view cate-list.blade.php, lấy dữ liệu từ biến $cates đã lấy ở hàm getCateList() để hiển thị ra bảng dữ liệu.
5.    Viết route kiểm tra kết quả trang cate-list.blade.php

LÀM ĐĂNG NHẬP CHO PHẦN QUẢN TRỊ
1.    Viết route:
Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);
2.    Tạo UserController bằng câu lệnh: php artisan make:controller UserController
Mở UserController, viết hàm getLogin(), postLogin(), getLogout():
use Illuminate\Support\Facades\Auth;

public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]
        );
        $credentials=array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect('/admin/category/danhsach')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
