<div class="accordion-item">
    <h2 class="accordion-header" id="heading-{{ $category->MaLoai }}">
        <button class="accordion-button {{ empty($category->children) ? 'collapsed' : '' }}" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $category->MaLoai }}" aria-expanded="true"
            aria-controls="collapse-{{ $category->MaLoai }}">
            {{ $category->TenLoai }}
        </button>
    </h2>
    <div id="collapse-{{ $category->MaLoai }}" class="accordion-collapse collapse show"
        aria-labelledby="heading-{{ $category->MaLoai }}" data-bs-parent="#categoryAccordion">
        <div class="accordion-body">
            <p><strong>Mô tả:</strong> {{ $category->MoTa ?? 'Không có mô tả' }}</p>
            <p><strong>Trạng thái:</strong> <span class="badge bg-danger">Đã xóa</span></p>
            <div class="btn-action">
                {{-- Nút khôi phục --}}
                <a href="{{ route('admin.category.restore', $category->MaLoai) }}" class="btn btn-success btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục danh mục {{ $category->TenLoai }}?')">
                    <i class="fas fa-undo"></i> Khôi phục
                </a>
            </div>

            {{-- Hiển thị danh mục con nếu có --}}
            @if (!empty($category->children))
                <div class="ms-4 mt-2">
                    @foreach ($category->children as $child)
                        @include('admin.Category.partials.trashed_category_row', ['category' => $child])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
