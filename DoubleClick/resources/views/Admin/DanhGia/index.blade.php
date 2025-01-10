@extends('Admin.layout')
{{-- @section('title', $title) --}}
{{-- @section('subtitle', $subtitle) --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/admindanhgia.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container mt-5 mb-5">
    <div class="content-container">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="text-primary">Đánh giá sách</h5>
            <div class="d-flex">
                <div class="input-group me-2" style="max-width: 300px;">
                    <input type="text" class="form-control" placeholder="Tìm kiếm tên sách ...">
                    <button class="btn btn-secondary" type="button">Tìm kiếm</button>
                </div>
                <div class="input-group" style="max-width: 171px;">
                    <select class="form-select">
                        <option value="">Lọc theo số sao</option>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="notification" class="alert" style="display: none;">
            <!-- Nội dung thông báo sẽ hiển thị ở đây -->
        </div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th style="width: 200px">Tên sách</th>
                        <th>Tên khách hàng</th>
                        <th style="width: 81px">Số sao</th>
                        <th style="width: 270px">Bình luận</th>
                        <th>Ngày đăng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhgia as $item)
                    <tr id="rating-{{ $item->MaTK }}-{{ $item->MaSach }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->TenSach }}</td>
                        <td>{{ $item->TenTK }}</td>
                        <td class="text-center">{{ $item->SoSao }}</td>
                        <td>{{ $item->DanhGia }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->NgayDang)->format('d/m/Y H:i:s') }}</td>
                        <td>
                            <button class="btn btn-delete" onclick="deleteRating({{ $item->MaTK }}, {{ $item->MaSach }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            @if ($danhgia->lastPage() > 1)
            <ul class="pagination">
                {{-- <!-- Mũi tên trái -->
            <li class="page-item {{ ($danhgia->currentPage() == 1) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $danhgia->previousPageUrl() }}" aria-label="Previous">&lt;</a>
                </li> --}}
                <!-- Trang đầu -->
                <li class="page-item {{ ($danhgia->currentPage() == 1) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $danhgia->url(1) }}" aria-label="First">Trang đầu</a>
                </li>

                <!-- Trang trước nếu không ở trang đầu -->
                @if ($danhgia->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $danhgia->url($danhgia->currentPage() - 1) }}">
                        {{ $danhgia->currentPage() - 1 }}
                    </a>
                </li>
                @endif

                <!-- Trang hiện tại -->
                <li class="page-item active">
                    <a class="page-link" href="#">{{ $danhgia->currentPage() }}</a>
                </li>

                <!-- Trang sau nếu không ở trang cuối -->
                @if ($danhgia->currentPage() < $danhgia->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $danhgia->url($danhgia->currentPage() + 1) }}">
                            {{ $danhgia->currentPage() + 1 }}
                        </a>
                    </li>
                    @endif

                    {{-- <!-- Mũi tên phải -->
                <li class="page-item {{ ($danhgia->currentPage() == $danhgia->lastPage()) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $danhgia->nextPageUrl() }}" aria-label="Next">&gt;</a>
                    </li> --}}
                    <!-- Trang cuối -->
                    <li class="page-item {{ ($danhgia->currentPage() == $danhgia->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $danhgia->url($danhgia->lastPage()) }}" aria-label="Last">Trang cuối</a>
                    </li>
            </ul>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="close" id="closeDeleteModalBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa đánh giá này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelDeleteBtn" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Xóa</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<script>
    // Biến lưu trữ id để xóa
    var matk, masach;
    // Hàm gọi khi nhấn nút xóa
    function deleteRating(matkParam, masachParam) {
        // Lưu giá trị của matk và masach vào biến
        matk = matkParam;
        masach = masachParam;

        // Mở modal xác nhận
        $('#confirmDeleteModal').modal('show');
    }

    // Xử lý khi người dùng xác nhận xóa
    $('#confirmDeleteBtn').click(function() {
        // Hiển thị thông báo "Đang xử lý xóa"
        showNotification('Đang xử lý xóa...', 'warning');

        // Đợi 5 giây trước khi gửi yêu cầu xóa
        setTimeout(function() {
            // Gửi yêu cầu AJAX để xóa
            $.ajax({
                url: '/admin/danhgia/' + matk + '/' + masach, // Đảm bảo URL đúng
                type: 'DELETE'
                , data: {
                    "_token": "{{ csrf_token() }}" // Gửi token CSRF để bảo vệ
                }
                , dataType: 'json'
                , success: function(response) {
                    if (response.success) {
                        // Hiển thị thông báo thành công
                        showNotification(response.message, 'success');

                        // Loại bỏ phần tử khỏi DOM sau khi xóa
                        $('#rating-' + matk + '-' + masach).remove(); // Giả sử mỗi phần tử có id theo kiểu "rating-matk-masach"

                    } else {
                        // Hiển thị thông báo lỗi
                        showNotification(response.message, 'error');
                    }
                    $('#confirmDeleteModal').modal('hide'); // Đóng modal
                }
                , error: function(xhr, status, error) {
                    // Hiển thị thông báo lỗi nếu có
                    showNotification('Có lỗi xảy ra, vui lòng thử lại!', 'error');
                    $('#confirmDeleteModal').modal('hide'); // Đóng modal ngay cả khi có lỗi
                }
            });
        }); // Đợi 5 giây trước khi thực hiện xóa
    });

    // Đảm bảo rằng modal sẽ đóng khi nhấn nút Hủy hoặc X
    $('#confirmDeleteModal').on('hidden.bs.modal', function() {
        // Reset các biến để tránh lỗi khi mở modal lần sau
        matk = null;
        masach = null;
    });

    // Hàm hiển thị thông báo
    function showNotification(message, type) {
        var notification = $('#notification');

        // Xóa các class cũ trước khi thêm class mới (nếu có)
        notification.removeClass('alert-success alert-danger alert-warning');

        // Thêm class tùy thuộc vào loại thông báo
        if (type === 'success') {
            notification.addClass('alert-success');
        } else if (type === 'error') {
            notification.addClass('alert-danger');
        } else {
            notification.addClass('alert-warning');
        }

        // Đặt nội dung thông báo
        notification.text(message);

        // Hiển thị thông báo
        notification.show();

        // Ẩn thông báo sau 5 giây
        setTimeout(function() {
            notification.hide();
        }, 5000); // Ẩn sau 5 giây
    }

</script>

@endsection
