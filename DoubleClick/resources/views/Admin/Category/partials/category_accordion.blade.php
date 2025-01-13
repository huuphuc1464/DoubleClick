<div class="accordion-item">
    <h2 class="accordion-header {{ $category->TrangThai == 0 ? 'bg-secondary text-white' : '' }}"
        id="heading-{{ $category->MaLoai }}">
        <button class="accordion-button {{ empty($category->children) ? 'collapsed' : '' }}" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $category->MaLoai }}" aria-expanded="true"
            aria-controls="collapse-{{ $category->MaLoai }}">
            <span>{{ $category->TenLoai }}</span>
        </button>
    </h2>
    <div id="collapse-{{ $category->MaLoai }}" class="accordion-collapse collapse show"
        aria-labelledby="heading-{{ $category->MaLoai }}" data-bs-parent="#categoryAccordion">
        <div class="accordion-body">
            <p><strong>Mô tả:</strong> {{ $category->MoTa ?? 'Không có mô tả' }}</p>
            <div class="d-flex align-items-center">
                <span class="badge me-3 {{ $category->TrangThai == 1 ? 'bg-success' : 'bg-dark' }}">
                    {{ $category->TrangThai == 1 ? 'Hoạt động' : 'Ẩn' }}
                </span>
                <div class="btn-group">
                    {{-- Nút sửa --}}
                    <a href="{{ route('admin.category.edit', $category->MaLoai) }}"
                        class="btn btn-primary btn-sm-custom" title="Sửa">
                        <i class="fas fa-edit"></i>
                    </a>
                    {{-- Nút xóa --}}
                    <a href="{{ route('admin.category.delete', $category->MaLoai) }}"
                        class="btn btn-danger btn-sm-custom" title="Xóa"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục {{ $category->TenLoai }}?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    {{-- Nút thêm danh mục con --}}
                    <a href="{{ route('admin.category.create', ['parent_id' => $category->MaLoai]) }}"
                        class="btn btn-success btn-sm-custom btn-add-child" title="Thêm danh mục con">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>

            {{-- Đệ quy hiển thị các danh mục con --}}
            @if (!empty($category->children))
                <div class="ms-4 mt-2">
                    @foreach ($category->children as $child)
                        @include('admin.Category.partials.category_accordion', ['category' => $child])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
