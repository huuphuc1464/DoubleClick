<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSachController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');

        // Truy vấn sách đang bán
        $sach = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 1)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // Truy vấn sách ngừng bán
        $ngungban = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 0)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // Truy vấn sách hết hàng
        $hethang = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 1)
            ->where('SoLuongTon', '<', 10)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        // Trả về view với các dữ liệu đã lọc
        return view('Admin.Sach.index', compact('sach', 'ngungban', 'hethang'));
    }
    public function edit($id)
    {
        $sach = DB::table('sach')
            ->where('MaSach', '=', $id)
            ->first();
        $title = "Sửa sách " . $id;
        $anhSach = DB::table('anhsach')
            ->where('MaSach', '=', $id)
            ->get();
        $loaiSach = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai')
            ->get();
        $boSach = DB::table('sach')
            ->select('TenBoSach')
            ->distinct() // Lấy các bộ không trùng lặp
            ->whereNotNull('TenBoSach')
            ->get();
        return view('Admin.Sach.update', compact('title', 'sach', 'loaiSach', 'boSach', 'anhSach'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        // Validate form input
        $validated = $request->validate([
            'AnhDaiDien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'TenSach' => 'required|string|max:255',
            'NXB' => 'required|integer|min:1000|max:2099',
            'GiaBan' => 'required|numeric|min:1000',
            'MaLoai' => 'required|exists:loaisach,MaLoai',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deleted_images' => 'nullable|array', // Danh sách ảnh cần xóa
        ]);

        // Lấy sách hiện tại
        $sach = DB::table('sach')->where('MaSach', $id)->first();
        if (!$sach) {
            return redirect()->back()->withErrors(['error' => 'Sách không tồn tại!']);
        }
        
        // Cập nhật thông tin sách
        DB::table('sach')->where('MaSach', $id)->update([
            'TenSach' => $validated['TenSach'],
            'NXB' => $validated['NXB'],
            'GiaBan' => $validated['GiaBan'],
            'MaLoai' => $validated['MaLoai'],
            'Slug' => $this->generateSlug($validated['TenSach'], $id),
            'TenTG' => $request->input('TenTG'),
            'TenBoSach' => $request->input('TenBoSach'),
            'MoTa' => $request->input('MoTa'),
        ]);

        // Xử lý ảnh đại diện
        if ($request->hasFile('AnhDaiDien')) {
            $anhDaiDienPath = $this->uploadImage($request->file('AnhDaiDien'), $id);

            // Xóa ảnh đại diện cũ nếu có
            if ($sach->AnhDaiDien && file_exists(public_path('img/sach/' . $sach->AnhDaiDien))) {
                unlink(public_path('img/sach/' . $sach->AnhDaiDien));
            }

            // Cập nhật ảnh đại diện
            DB::table('sach')->where('MaSach', $id)->update([
                'AnhDaiDien' => $anhDaiDienPath,
            ]);
        }

        // Xử lý xóa hình ảnh
        if ($request->filled('deleted_images')) {
            foreach ($request->deleted_images as $deletedImageId) {
                $image = DB::table('anhsach')->where('id', $deletedImageId)->first();
                if ($image && file_exists(public_path('img/sach/' . $image->HinhAnh))) {
                    unlink(public_path('img/sach/' . $image->HinhAnh));
                }
                DB::table('anhsach')->where('id', $deletedImageId)->delete();
            }
        }

        // Xử lý thêm hình ảnh mới
        if ($request->hasFile('images')) {
            $index = DB::table('anhsach')->where('MaSach', $id)->count() + 1;
            foreach ($request->file('images') as $image) {
                $imagePath = $this->uploadImage($image, $id . '_' . $index);
                DB::table('anhsach')->insert([
                    'MaSach' => $id,
                    'HinhAnh' => $imagePath,
                ]);
                $index++;
            }
        }

        return redirect()->route('admin.sach')->with('success', 'Cập nhật sách và hình ảnh thành công!');
    }

    public function detail()
    {
        return view('Admin.Sach.detail');
    }

    public function destroy($id)
    {
        $item = Sach::findOrFail($id);

        $item->TrangThai = 0;
        $item->save();

        return response()->json(['success' => 'Xóa sách thành công']);
    }

    public function undo($id)
    {
        $item = Sach::findOrFail($id);

        $item->TrangThai = 1;
        $item->save();

        return response()->json(['success' => 'Khôi phục sách thành công']);
    }

    public function insert()
    {
        $title = "Thêm sách mới";
        $loaiSach = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai')
            ->get();
        $boSach = DB::table('sach')
            ->select('TenBoSach')
            ->distinct() // Lấy các bộ không trùng lặp
            ->whereNotNull('TenBoSach')
            ->get();
        return view('Admin.Sach.insert', compact('title', 'loaiSach', 'boSach'));
    }

    public function store(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'AnhDaiDien' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'TenSach' => 'required|string|max:255',
            'NXB' => 'required|integer|min:1000|max:2099',
            'GiaBan' => 'required|numeric|min:1000',
            'MaLoai' => 'required|exists:loaisach,MaLoai',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Lưu sách vào bảng sach trước để lấy MaSach
        $maSach = DB::table('sach')->insertGetId([
            'TenSach' => $validated['TenSach'],
            'NXB' => $validated['NXB'],
            'GiaBan' => $validated['GiaBan'],
            'MaLoai' => $validated['MaLoai'],
            'Slug' => 'null',
            'ISBN' => $validated['ISBN'] ?? 'null',
            'AnhDaiDien' => 'null',
            'GiaNhap' => 0,
            'SoLuongTon' => 0,
            'TenTG' => $request->input('TenTG'),
            'TenBoSach' => $request->input('TenBoSach'),
            'MoTa' => $request->input('MoTa'),
            'TrangThai' => 1
        ]);

        // Tạo slug từ tên sách và kiểm tra tính duy nhất
        $slug = $this->generateSlug($validated['TenSach'], $maSach);

        // Cập nhật lại slug trong bảng sach
        DB::table('sach')->where('MaSach', $maSach)->update([
            'Slug' => $slug,
        ]);

        // Lưu ảnh đại diện với tên MaSach.extension
        if ($request->hasFile('AnhDaiDien')) {
            $anhDaiDienPath = $this->uploadImage(
                $request->file('AnhDaiDien'),
                $maSach
            );

            // Cập nhật lại ảnh đại diện trong bảng sach
            DB::table('sach')->where('MaSach', $maSach)->update([
                'AnhDaiDien' => $anhDaiDienPath,
            ]);
        }

        // Lưu danh sách hình ảnh vào bảng AnhSach
        if ($request->hasFile('images')) {
            $index = 1;
            foreach ($request->file('images') as $image) {
                $imagePath = $this->uploadImage(
                    $image,
                    $maSach . '_' . $index
                );
                DB::table('anhsach')->insert([
                    'MaSach' => $maSach,
                    'HinhAnh' => $imagePath,
                ]);
                $index++;
            }
        }

        return redirect()->route('admin.sach')->with('success', 'Thêm sách và hình ảnh thành công!');
    }

    private function generateSlug($tenSach, $maSach = null)
    {
        $slug = Str::slug($tenSach);

        // Kiểm tra nếu slug đã tồn tại
        $existingSlug = DB::table('sach')->where('Slug', $slug)->first();

        if ($existingSlug) {
            // Nếu đã tồn tại, thêm MaSach vào cuối slug
            if ($maSach) {
                $slug = $slug . '-' . $maSach;
            } else {
                // Nếu không có MaSach, thêm thời gian vào cuối slug để đảm bảo tính duy nhất
                $slug = $slug . '-' . time();
            }
        }
        return $slug;
    }

    // Hàm upload ảnh với tên tùy chỉnh
    private function uploadImage($image, $customName)
    {
        $path = 'img/sach';
        $extension = $image->getClientOriginalExtension();
        $fileName = $customName . '.' . $extension;
        $image->move(public_path($path), $fileName);
        return $fileName;
    }
}