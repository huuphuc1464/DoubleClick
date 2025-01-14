<?php

namespace App\Http\Controllers;

use App\Models\LoaiSach;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            // Tìm tất cả danh mục khớp với từ khóa (bất kể cấp bậc)
            $matchedCategories = DB::table('loaisach')
                ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai', 'MaLoaiCha')
                ->where('TrangThai', '!=', 2)
                ->where('TenLoai', 'like', "%{$search}%")
                ->get();

            if ($matchedCategories->isEmpty()) {
                // Nếu không tìm thấy danh mục
                $allCategories = collect();
            } else {
                // Lấy tất cả danh mục con của các danh mục khớp
                $allCategories = $this->getMatchedCategoriesWithDescendants($matchedCategories);
            }
        } else {
            // Lấy toàn bộ danh mục nếu không có từ khóa
            $allCategories = DB::table('loaisach')
                ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai', 'MaLoaiCha')
                ->where('TrangThai', '!=', 2)
                ->get();
        }

        // Xây dựng cây danh mục
        $categoryTree = $this->buildCategoryTree($allCategories);

        $viewData = [
            "title" => "Quản lý danh mục sách",
            "subtitle" => "Danh mục sách",
            "listCate" => $categoryTree,
            "search" => $search,
        ];

        return view(
            'admin.Category.index',
            $viewData
        );
    }



    // Tạo danh mục mới
    public function create($parent_id = null)
    {
        $parentCategory = null;

        if ($parent_id) {
            $parentCategory = LoaiSach::find($parent_id);
            if (!$parentCategory) {
                return redirect()->route('admin.category')->with('error', 'Danh mục cha không tồn tại.');
            }
        }

        return view('admin.Category.create', [
            'title' => 'Thêm danh mục',
            'subtitle' => $parent_id ? 'Thêm danh mục con' : 'Thêm danh mục gốc',
            'parentCategory' => $parentCategory,
        ]);
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'TenLoai' => 'required|regex:/^[^\d]+$/u|max:50|unique:loaisach,TenLoai',
            'MoTa' => 'nullable|max:255',
            'TrangThai' => 'required|in:0,1',
        ], [
            'TenLoai.required' => 'Tên danh mục là bắt buộc.',
            'TenLoai.unique' => 'Tên danh mục đã tồn tại.',
            'TrangThai.required' => 'Trạng thái là bắt buộc.',
        ]);

        $slug = Str::slug($request->input('TenLoai'));

        // Kiểm tra trùng lặp slug
        $existingSlugCount = DB::table('loaisach')
            ->where('SlugLoai', $slug)
            ->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        LoaiSach::create([
            'TenLoai' => $request->input('TenLoai'),
            'SlugLoai' => $slug,
            'MoTa' => $request->input('MoTa'),
            'TrangThai' => $request->input('TrangThai'),
            'MaLoaiCha' => $request->input('MaLoaiCha'),
        ]);

        return redirect()->route('admin.category')->with('success', 'Danh mục mới đã được thêm thành công!');
    }

    // Chỉnh sửa danh mục
    public function edit($id)
    {
        $category = LoaiSach::find($id);

        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại.');
        }

        return view('admin.Category.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $message = [
            'MoTa.regex' => "Chỉ cho phép nhập chữ cái và khoảng trắng",
            'TenLoai.regex' => "Chỉ cho phép nhập chữ cái và khoảng trắng",
            'TenLoai.unique' => "Tên danh mục đã tồn tại. Vui lòng chọn tên khác."
        ];

        $request->validate([
            'TenLoai' => 'required|regex:/^[^\d]+$/u|max:100|unique:loaisach,TenLoai,' . $id . ',MaLoai',
            'MoTa' => 'nullable|regex:/^[^\d]+$/u|max:100',
            'TrangThai' => 'required|in:0,1',
        ], $message);

        $slug = Str::slug($request->input('TenLoai'));

        // Kiểm tra trùng lặp slug
        $existingSlugCount = DB::table('loaisach')
            ->where('SlugLoai', $slug)
            ->where('MaLoai', '!=', $id)
            ->count();

        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        $newStatus = $request->input('TrangThai');

        DB::transaction(function () use ($id, $slug, $newStatus, $request) {
            DB::table('loaisach')
                ->where('MaLoai', $id)
                ->update([
                    'TenLoai' => $request->input('TenLoai'),
                    'SlugLoai' => $slug,
                    'MoTa' => $request->input('MoTa'),
                    'TrangThai' => $newStatus,
                ]);

            $descendants = $this->getAllDescendants(collect([LoaiSach::find($id)]));

            foreach ($descendants as $descendant) {
                DB::table('loaisach')
                    ->where('MaLoai', $descendant->MaLoai)
                    ->update(['TrangThai' => $newStatus]);
            }
        });

        return redirect()->route('admin.category')->with('success', 'Cập nhật danh mục và các danh mục con thành công!');
    }

    // Xóa danh mục
    public function delete($id)
    {
        $category = LoaiSach::find($id);

        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại.');
        }

        DB::transaction(function () use ($category) {
            // Lấy tất cả danh mục con của danh mục bị xóa
            $descendants = $this->getAllDescendants(collect([$category]));

            // Cập nhật trạng thái của tất cả danh mục con (không thay đổi MaLoaiCha)
            foreach ($descendants as $descendant) {
                LoaiSach::where('MaLoai', $descendant->MaLoai)->update(['TrangThai' => 2]);
            }

            // Cập nhật trạng thái của danh mục bị xóa
            $category->update(['TrangThai' => 2]);
        });

        return redirect()->route('admin.category')->with('success', 'Danh mục và tất cả danh mục con đã được chuyển vào thùng rác.');
    }


    // Hiển thị danh mục đã xóa
    public function trashed()
    {
        $trashedCategories = DB::table('loaisach')
            ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai', 'MaLoaiCha')
            ->where('TrangThai', 2)
            ->get();

        $categoryTree = $this->buildCategoryTree($trashedCategories);

        return view('admin.Category.trashed', [
            'title' => 'Danh mục đã xóa',
            'subtitle' => 'Danh mục đã xóa',
            'listCate' => $categoryTree,
        ]);
    }

    // Khôi phục danh mục
    public function restore($id)
    {
        $category = LoaiSach::find($id);

        if (!$category || $category->TrangThai != 2) {
            return redirect()->route('admin.category')->with('error', 'Danh mục không tồn tại hoặc không thể khôi phục.');
        }

        DB::transaction(function () use ($category) {
            // Lấy tất cả danh mục con của danh mục bị xóa
            $descendants = $this->getAllDescendants(collect([$category]));

            // Khôi phục trạng thái của tất cả danh mục con
            foreach ($descendants as $descendant) {
                LoaiSach::where('MaLoai', $descendant->MaLoai)->update(['TrangThai' => 1]);
            }

            // Khôi phục trạng thái của danh mục cha
            $category->update(['TrangThai' => 1]);
        });

        return redirect()->route('admin.category')->with('success', 'Danh mục và tất cả danh mục con đã được khôi phục thành công!');
    }


    // Hàm lấy tất cả danh mục con
    private function getAllDescendants($categories)
    {
        $allCategories = collect($categories);

        foreach ($categories as $category) {
            $descendants = DB::table('loaisach')
                ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai', 'MaLoaiCha')
                ->where('MaLoaiCha', $category->MaLoai)
                ->get();

            if ($descendants->isNotEmpty()) {
                $allCategories = $allCategories->merge($this->getAllDescendants($descendants));
            }
        }

        return $allCategories->unique('MaLoai');
    }

    private function getMatchedCategoriesWithDescendants($categories)
    {
        $allCategories = collect($categories);

        foreach ($categories as $category) {
            // Lấy danh mục con của danh mục hiện tại
            $descendants = DB::table('loaisach')
                ->select('MaLoai', 'TenLoai', 'SlugLoai', 'MoTa', 'TrangThai', 'MaLoaiCha')
                ->where('TrangThai', '!=', 2)
                ->where('MaLoaiCha', $category->MaLoai)
                ->get();

            if ($descendants->isNotEmpty()) {
                $allCategories = $allCategories->merge($this->getMatchedCategoriesWithDescendants($descendants));
            }
        }

        return $allCategories->unique('MaLoai'); // Loại bỏ các danh mục trùng lặp
    }



    // Xây dựng cây danh mục
    private function buildCategoryTree($categories, $parentId = null)
    {
        $tree = [];
        foreach ($categories as $category) {
            if ($category->MaLoaiCha == $parentId) {
                $children = $this->buildCategoryTree($categories, $category->MaLoai);
                if (!empty($children)) {
                    $category->children = $children;
                }
                $tree[] = $category;
            }
        }
        return $tree;
    }
}
