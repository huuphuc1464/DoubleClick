@extends('Admin.layout')

@section('title', 'Chỉnh Sửa Thông Tin WebSite')

{{-- Chưa có hàm  old để giữ lại dữ liệu cũ --}}
@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Chỉnh sửa thông tin Website</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.website.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="DiaChi" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="DiaChi" name="DiaChi"
                    value="{{ old('DiaChia', $website->DiaChi) }}" required>
            </div>
            <div class="mb-3">
                <label for="Website" class="form-label">Website</label>
                <input type="text" class="form-control" id="Website" name="Website"
                    value="{{ old('Website', $website->Website) }}" required>
            </div>
            <div class="mb-3">
                <label for="SDT" class="form-label">Số điện thoại </label>
                <input type="text" class="form-control" id="SDT" name="SDT"
                    value="{{ old('SDT', $website->SDT) }}" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email"
                    value="{{ old('Email', $website->Email) }}" required>
            </div>
            <div class="mb-3">
                <label for="Logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="Logo" name="Logo" accept="image/*"
                    value="{{ old('Logo', $website->Logo) }}">

                <!-- Hiển thị hình ảnh hiện tại hoặc hình ảnh đã chọn -->
                <img id="preview-logo" src="{{ asset('img/' . $website->Logo) }}" alt="Logo hiện tại"
                    class="img-thumbnail mt-2" width="150">
            </div>

            <div class="mb-3">
                <label for="Facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control" id="Facebook" name="Facebook" value="{{ $website->Facebook }}"
                    required>


            </div>
            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
            <a href="{{ route('admin.dashbroad') }}" class="btn btn-secondary">Quay Lại</a>
        </form>

    </div>
    <script>
        //Thêm sự kiện sau khi cấu trúc html đã đươc load xong (nhưng mà thẻ script này ở cuối nên điều này  cũng không cần thiết lắm :))
        document.addEventListener("DOMContentLoaded", function() {
            const logoInput = document.getElementById("Logo");
            console.log(logoInput);
            const previewLogo = document.getElementById("preview-logo");

            logoInput.addEventListener("change", function(event) {
                const file = event.target.files[0]; // Lấy file đã chọn

                if (file) {
                    //kiểm tra xem file có phải là hình ảnh hay không

                    if (file.type.startsWith("image/")) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            //Hiển thị hình ảnh đã chọn
                            console.log(e.target);
                            previewLogo.setAttribute("src", e.target.result);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        alert("Vui lòng chọn file ảnh hợp lệ!");
                        // Reset input và giữ lại hình ảnh cũ
                        logoInput.value = "";
                        previewLogo.src = "{{ asset('img/' . $website->Logo) }}"
                    }
                } else {
                    // Nếu không chọn file thì dữ nguyên hình ảnh cũ
                    previewLogo.src = "{{ asset('img/' . $website->Logo) }}"
                }
            })
        })
    </script>

@endsection
