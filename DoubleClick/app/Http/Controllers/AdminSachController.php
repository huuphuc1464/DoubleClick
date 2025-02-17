<?php

namespace App\Http\Controllers;

use App\Models\LoaiSach;
use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            ->orderByDesc('MaSach')
            ->paginate(10);

        // Truy vấn sách ngừng bán
        $ngungban = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 0)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->orderByDesc('MaSach')
            ->paginate(10);

        // Truy vấn sách hết hàng
        $hethang = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('sach.TrangThai', '=', 1)
            ->where('SoLuongTon', '<', 10)
            ->when($search, function ($query, $search) {
                return $query->where('sach.TenSach', 'like', '%' . $search . '%');
            })
            ->orderByDesc('MaSach')
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
        $parentCategories = DB::table('loaisach')->get();
        return view('Admin.Sach.update', compact('title', 'sach', 'loaiSach', 'boSach', 'anhSach', 'parentCategories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'MaLoai' => 'required|exists:loaisach,MaLoai|integer',
            'TenSach' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sach')->ignore($id, 'MaSach')->where(function ($query) {
                    $query->whereRaw('BINARY TenSach = ?', [request()->input('TenSach')]);
                }),
            ],
            'TenTG' => 'nullable|string|max:50',
            'TenBoSach' => 'nullable|string|max:100',
            'NXB' => 'required|integer|min:1000|max:' . date('Y'),
            'ISBN' => 'required|string|max:50',
            'AnhDaiDien' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'MoTa' => 'nullable|string|max:100',
            'GiaBan' => 'required|numeric|min:1000',
            'TrangThai' => 'required|integer|in:0,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            // Tùy chỉnh thông báo lỗi
            'MaLoai.required' => 'Vui lòng chọn loại sách.',
            'MaLoai.exists' => 'Loại sách không tồn tại trong hệ thống.',
            'TenSach.required' => 'Tên sách là bắt buộc.',
            'TenSach.unique' => 'Tên sách đã tồn tại.',
            'TenSach.string' => 'Tên sách phải là chuỗi ký tự.',
            'TenSach.max' => 'Tên sách không được vượt quá 50 ký tự.',
            'TenTG.string' => "Tên tác giả phải là chuổi ký tự",
            'TenTG.max' => 'Tên tác giả không được vượt quá 50 ký tự.',
            'TenBoSach.max' => 'Tên bộ sách không được vượt quá 100 ký tự.',
            'TenBoSach.string' => "Tên bộ sách phải là chuổi ký tự",
            'NXB.required' => 'Năm xuất bản là bắt buộc.',
            'NXB.integer' => 'Năm xuất bản phải là số nguyên.',
            'NXB.min' => 'Năm xuất bản phải từ năm 1000 trở lên.',
            'NXB.max' => 'Năm xuất bản không được vượt quá ' . date('Y') . '.',
            'ISBN.required' => 'ISBN là bắt buộc.',
            'ISBN.string' => 'ISBN phải là chuỗi ký tự.',
            'ISBN.max' => 'ISBN không được vượt quá 50 ký tự.',
            'AnhDaiDien.image' => 'Ảnh bìa phải là hình ảnh hợp lệ.',
            'AnhDaiDien.mimes' => 'Ảnh bìa chỉ hỗ trợ định dạng jpeg, png, jpg.',
            'AnhDaiDien.max' => 'Dung lượng ảnh bìa không được vượt quá 2MB.',
            'MoTa.string' => 'Mô tả phải là chuỗi ký tự.',
            'MoTa.max' => 'Mô tả không được vượt quá 100 ký tự.',
            'GiaBan.required' => 'Giá bán là bắt buộc.',
            'GiaBan.numeric' => 'Giá bán phải là số.',
            'GiaBan.min' => 'Giá bán phải lớn hơn hoặc bằng 1000.',
            'TrangThai.required' => 'Trạng thái là bắt buộc.',
            'TrangThai.in' => 'Trạng thái chỉ chấp nhận giá trị 0 hoặc 1.',
            'images.*.image' => 'Từng hình ảnh phải là file hợp lệ.',
            'images.*.mimes' => 'Hình ảnh chỉ chấp nhận định dạng jpeg, png, jpg.',
            'images.*.max' => 'Dung lượng mỗi hình ảnh không được vượt quá 2MB.',
        ]);


        // Lấy sách hiện tại
        $sach = DB::table('sach')->where('MaSach', $id)->first();
        if (!$sach) {
            return redirect()->back()->withErrors(['error' => 'Sách không tồn tại!']);
        }

        if (intval($sach->SoLuongTon) > 0 && $request->input('TrangThai') == 0) {
            return back()->with(['error' => 'Không thể thay đổi trạng thái thành ngưng bán khi còn sản phẩm tồn kho']);
        }

        // Cập nhật thông tin sách
        DB::table('sach')->where('MaSach', $id)->update([
            'TenSach' => $request->input('TenSach'),
            'TenTG' => $request->input('TenTG'),
            'TenBoSach' => $request->input('TenBoSach'),
            'NXB' => $request->input('NXB'),
            'ISBN' => $request->input('ISBN'),
            'MoTa' => $request->input('MoTa'),
            'GiaBan' => $request->input('GiaBan'),
            'MaLoai' => $request->input('MaLoai'),
            'Slug' => $this->generateSlug($request->input('TenSach'), $id),
            'TrangThai' => $request->input('TrangThai'),
        ]);

        // Xử lý ảnh bìa
        if ($request->hasFile('AnhDaiDien')) {
            $anhDaiDienPath = $this->uploadImage($request->file('AnhDaiDien'), $id);

            // Xóa ảnh bìa cũ nếu có
            if ($sach->AnhDaiDien && file_exists(public_path('img/sach/' . $sach->AnhDaiDien))) {
                unlink(public_path('img/sach/' . $sach->AnhDaiDien));
            }

            // Cập nhật ảnh bìa
            DB::table('sach')->where('MaSach', $id)->update([
                'AnhDaiDien' => $anhDaiDienPath,
            ]);
        }

        // Xử lý xóa hình ảnh
        if ($request->filled('deleted_images')) {
            // Giải mã chuỗi JSON thành mảng (nếu cần)
            $deletedImages = json_decode($request->input('deleted_images'), true);
            //dd($deletedImages);
            if (is_array($deletedImages) && count($deletedImages) > 0) {
                foreach ($deletedImages as $deletedImageId) {
                    $image = DB::table('anhsach')->where('HinhAnh', $deletedImageId)->first();
                    if ($image && file_exists(public_path('img/sach/' . $image->HinhAnh))) {
                        unlink(public_path('img/sach/' . $image->HinhAnh));
                    }
                    DB::table('anhsach')->where('HinhAnh', $deletedImageId)->delete();
                }
            }
        }

        // Xử lý thêm hình ảnh mới
        if ($request->hasFile('new_images')) {
            // Lấy tất cả tên ảnh hiện có cho sản phẩm MaSach
            $existingImages = DB::table('anhsach')->where('MaSach', $id)->pluck('HinhAnh')->toArray();

            // Mảng để lưu các số thứ tự
            $indexes = [];

            // Lặp qua tất cả các tên ảnh đã có để trích xuất số thứ tự
            foreach ($existingImages as $image) {
                // Trích xuất số thứ tự từ tên ảnh (ví dụ: 16_1.jpg -> lấy số 1)
                preg_match('/' . $id . '_(\d+)\./', $image, $matches);

                if (isset($matches[1])) {
                    // Thêm số thứ tự vào mảng
                    $indexes[] = (int) $matches[1];
                }
            }

            // Lấy giá trị số thứ tự lớn nhất hiện có
            $index = !empty($indexes) ? max($indexes) + 1 : 1;  // Nếu không có ảnh nào, bắt đầu từ 1

            foreach ($request->file('new_images') as $image) {
                // Tạo tên ảnh mới
                $imagePath = $this->uploadImage($image, $id . '_' . $index);

                // Thêm hình ảnh mới vào cơ sở dữ liệu
                DB::table('anhsach')->insert([
                    'MaSach' => $id,
                    'HinhAnh' => $imagePath,
                ]);

                // Tăng số thứ tự cho ảnh tiếp theo
                $index++;
            }
        }


        return redirect()->route('admin.sach')->with('success', 'Cập nhật sách và hình ảnh thành công!');
    }

    public function detail($id)
    {
        $title = "Chi tiết sách " . $id;
        $sach = DB::table('sach')
            ->join('loaisach', 'loaisach.MaLoai', '=', 'sach.MaLoai')
            ->where('MaSach', '=', $id)
            ->select('sach.*', 'loaisach.TenLoai')
            ->first();
        $anhSach = DB::table('anhsach')
            ->where('MaSach', '=', $id)
            ->get();
        return view('Admin.Sach.detail', compact('sach', 'anhSach', 'title'));
    }

    public function destroy($id)
    {
        $item = Sach::findOrFail($id);

        if ($item->SoLuongTon > 0) {
            return response()->json(['error' => 'Không thể xóa sách khi còn sách trong kho.']);
        }

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

        // Lấy danh sách loại sách (có thể là các loại sách cha)
        $loaiSach = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai')
            ->get();

        // Lấy danh sách bộ sách, chỉ lấy các bộ sách không trùng lặp
        $boSach = DB::table('sach')
            ->select('TenBoSach')
            ->distinct() // Lấy các bộ không trùng lặp
            ->whereNotNull('TenBoSach')
            ->get();

        // Lấy danh sách tất cả các loại sách (bao gồm loại cha)
        $parentCategories = DB::table('loaisach')->get();

        // Trả về view với các dữ liệu cần thiết
        return view('Admin.Sach.insert', compact('title', 'loaiSach', 'boSach', 'parentCategories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'MaLoai' => 'required|exists:loaisach,MaLoai|integer',
            'TenSach' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sach')->where(function ($query) {
                    $query->whereRaw('BINARY TenSach = ?', [request()->input('TenSach')]);
                }),
            ],
            'TenTG' => 'nullable|string|max:50',
            'TenBoSach' => 'nullable|string|max:100',
            'NXB' => 'required|integer|min:1000|max:' . date('Y'),
            'ISBN' => 'required|string|max:50',
            'AnhDaiDien' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'MoTa' => 'nullable|string|max:100',
            'GiaBan' => 'required|numeric|min:1000',
            'images' => 'required|array|max:9',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'MaLoai.required' => 'Vui lòng chọn loại sách.',
            'MaLoai.exists' => 'Loại sách không tồn tại trong hệ thống.',
            'TenSach.required' => 'Tên sách là bắt buộc.',
            'TenSach.unique' => 'Tên sách đã tồn tại.',
            'TenSach.string' => 'Tên sách phải là chuỗi ký tự.',
            'TenSach.max' => 'Tên sách không được vượt quá 50 ký tự.',
            'TenTG.max' => 'Tên tác giả không được vượt quá 50 ký tự.',
            'TenTG.string' => "Tên tác giả phải là chuỗi ký tự",
            'TenBoSach.max' => 'Tên bộ sách không được vượt quá 100 ký tự.',
            'TenBoSach.string' => "Tên bộ sách phải là chuỗi ký tự.",
            'NXB.required' => 'Năm xuất bản là bắt buộc.',
            'NXB.integer' => 'Năm xuất bản phải là số nguyên.',
            'NXB.min' => 'Năm xuất bản phải từ năm 1000 trở lên.',
            'NXB.max' => 'Năm xuất bản không được vượt quá ' . date('Y') . '.',
            'ISBN.required' => 'ISBN là bắt buộc.',
            'ISBN.string' => 'ISBN phải là chuỗi ký tự.',
            'ISBN.max' => 'ISBN không được vượt quá 50 ký tự.',
            'AnhDaiDien.required' => 'Ảnh bìa là bắt buộc.',
            'AnhDaiDien.image' => 'Ảnh bìa phải là hình ảnh hợp lệ.',
            'AnhDaiDien.mimes' => 'Ảnh bìa chỉ hỗ trợ định dạng jpeg, png, jpg.',
            'AnhDaiDien.max' => 'Dung lượng ảnh bìa không được vượt quá 2MB.',
            'MoTa.string' => 'Mô tả phải là chuỗi ký tự.',
            'MoTa.max' => 'Mô tả không được vượt quá 100 ký tự.',
            'GiaBan.required' => 'Giá bán là bắt buộc.',
            'GiaBan.numeric' => 'Giá bán phải là số.',
            'GiaBan.min' => 'Giá bán phải lớn hơn hoặc bằng 1000.',
            'images.required' => 'Danh sách ảnh sách là bắt buộc',
            'images.array' => 'Danh sách ảnh không hợp lệ.',
            'images.max' => 'Bạn chỉ được tải lên tối đa 9 hình ảnh.',
            'images.*.image' => 'Mỗi tệp phải là một hình ảnh.',
            'images.*.mimes' => 'Hình ảnh chỉ chấp nhận các định dạng: jpeg, png, jpg.',
            'images.*.max' => 'Kích thước tối đa cho mỗi hình ảnh là 2MB.',
        ]);


        // Lưu sách vào bảng sach trước để lấy MaSach
        $maSach = DB::table('sach')->insertGetId([
            'TenSach' => $request->input('TenSach'),
            'NXB' => $request->input('NXB'),
            'GiaBan' => $request->input('GiaBan'),
            'MaLoai' => $request->input('MaLoai'),
            'Slug' => 'null',
            'ISBN' => $request->input('ISBN'),
            'AnhDaiDien' => 'null',
            'GiaNhap' => 0,
            'SoLuongTon' => 0,
            'TenTG' => $request->input('TenTG') ?: 'null',
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

        // Lưu ảnh bìa với tên MaSach.extension
        if ($request->hasFile('AnhDaiDien')) {
            $anhDaiDienPath = $this->uploadImage(
                $request->file('AnhDaiDien'),
                $maSach
            );

            // Cập nhật lại ảnh bìa trong bảng sach
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

    public function luuDanhMuc(Request $request)
    {
        $request->validate([
            'TenLoai' => 'required|regex:/^[^\d]+$/u|max:50|unique:loaisach,TenLoai',
            'MoTa' => 'nullable|max:255',
            'MaLoaiCha' => 'nullable|exists:loaisach,MaLoai',
        ], [
            'TenLoai.required' => 'Tên danh mục là bắt buộc.',
            'TenLoai.unique' => 'Tên danh mục đã tồn tại.',
        ]);

        $slug = Str::slug($request->input('TenLoai'));

        // Kiểm tra trùng lặp slug
        $existingSlugCount = DB::table('loaisach')
            ->where('SlugLoai', $slug)
            ->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        $category = LoaiSach::create([
            'TenLoai' => $request->input('TenLoai'),
            'SlugLoai' => $slug,
            'MoTa' => $request->input('MoTa'),
            'TrangThai' => $request->input('TrangThai'),
            'MaLoaiCha' => $request->input('MaLoaiCha') === 'null' ? null : $request->input('MaLoaiCha'),
        ]);

        return response()->json([
            'success' => true,
            'category' => $category,  // Trả về thông tin danh mục mới
        ]);
    }
}