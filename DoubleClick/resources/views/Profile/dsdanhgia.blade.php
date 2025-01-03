@extends('Profile.sublayout')

@section('css_sub')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .text-center {
        text-align: center;
    }

    .img-text {
        text-align: left;
    }

</style>

@endsection

@section('content_sub')
<div class="container mt-4">
    <h5>
        Nhận xét của tôi
    </h5>

    @if($danhgia->isEmpty())
    Hiện tại bạn chưa có đánh giá nào.
    @else

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col" class="text-center">
                    STT
                </th>
                <th scope="col">
                    Sách
                </th>
                <th scope="col" class="text-center">
                    Số sao
                </th>
                <th scope="col" style="width: 35%">
                    Đánh giá
                </th>
                <th scope="col">
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($danhgia as $item)
            <tr>
                <th scope="row" class="text-center">
                    {{ $loop->iteration }}
                </th>
                <td class="img-text">

                    <img alt="Book cover of {{ $item->TenSach }}" class="img-fluid me-2" height="75" src="https://storage.googleapis.com/a1aa/image/lt6D5CapKkZENVsJJkBJ8IJJqDoXVrQ86VAtEEpLsLkSQ7fJA.jpg" width="50" />
                    {{ $item->TenSach }}
                </td>
                <td class="text-center">
                    {{ $item->SoSao }} <i class="fas fa-star" style="color: #ffc107;"></i>
                </td>

                <td style="width: 35%">
                    {{ $item->DanhGia }}
                </td>
                <td class="text-center">
                    <button class="btn btn-link text-danger delete-btn" data-id="{{ $item->MaSach }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                    Trước
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">
                    1
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">
                    Sau
                </a>
            </li>
        </ul>
    </nav>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const notification = document.getElementById('notification'); // Đảm bảo bạn có phần tử này trong HTML

        if (!notification) {
            console.error('Không tìm thấy phần tử thông báo.');
            return;
        }

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (!id) {
                    console.error('ID không xác định cho nút xóa này.');
                    return;
                }

                const confirmDelete = confirm('Bạn có chắc chắn muốn xóa đánh giá này?');
                if (!confirmDelete) return;

                fetch(`/profile/danhsachdanhgia/xoa/${id}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            , 'Content-Type': 'application/json'
                        , }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo trong DOM và đổi màu thông báo thành xanh
                            notification.classList.remove('alert-danger');
                            notification.classList.add('alert-success');
                            notification.textContent = data.message;

                            // Xóa dòng khỏi bảng
                            this.closest('tr').remove();

                            // Hiển thị thông báo và ẩn sau 3 giây
                            notification.style.display = 'block';
                            setTimeout(() => {
                                notification.style.display = 'none';
                            }, 3000);
                        } else {
                            // Hiển thị thông báo lỗi và đổi màu thông báo thành đỏ
                            notification.classList.remove('alert-success');
                            notification.classList.add('alert-danger');
                            notification.textContent = data.message || 'Đã xảy ra lỗi, vui lòng thử lại.';

                            // Hiển thị thông báo và ẩn sau 3 giây
                            notification.style.display = 'block';
                            setTimeout(() => {
                                notification.style.display = 'none';
                            }, 3000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Hiển thị thông báo lỗi và đổi màu thông báo thành đỏ
                        notification.classList.remove('alert-success');
                        notification.classList.add('alert-danger');
                        notification.textContent = 'Đã xảy ra lỗi, vui lòng thử lại.';

                        // Hiển thị thông báo và ẩn sau 3 giây
                        notification.style.display = 'block';
                        setTimeout(() => {
                            notification.style.display = 'none';
                        }, 3000);
                    });
            });
        });
    });

</script>
@endsection
