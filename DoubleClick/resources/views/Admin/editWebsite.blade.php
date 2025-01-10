<div class="container mt-4">
    <h1 class="h3 mb-4 text-gray-800">Chỉnh sửa thông tin Website</h1>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form chỉnh sửa thông tin website -->
    <form action="{{ route('admin.website.updateInfo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Địa chỉ -->
        <div class="mb-3">
            <label for="DiaChi" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="DiaChi" name="DiaChi"
                value="{{ old('DiaChi', $website->DiaChi) }}" required>
        </div>

        <!-- Tên website -->
        <div class="mb-3">
            <label for="Website" class="form-label">Website</label>
            <input type="text" class="form-control" id="Website" name="Website"
                value="{{ old('Website', $website->Website) }}" required>
        </div>

        <!-- Số điện thoại -->
        <div class="mb-3">
            <label for="SDT" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="SDT" name="SDT"
                value="{{ old('SDT', $website->SDT) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input type="email" class="form-control" id="Email" name="Email"
                value="{{ old('Email', $website->Email) }}" required>
        </div>

        <!-- Logo -->
        <div class="mb-3">
            <label for="Logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="Logo" name="Logo" accept="image/*"
                value="{{ old('Logo', $website->Logo) }}">

            <!-- Hiển thị hình ảnh logo hiện tại hoặc hình ảnh đã chọn -->
            <img id="preview-logo" src="{{ asset('img/' . $website->Logo) }}" alt="Logo hiện tại"
                class="img-thumbnail mt-2" width="150">
        </div>

        <!-- Facebook -->
        <div class="mb-3">
            <label for="Facebook" class="form-label">Facebook</label>
            <input type="text" class="form-control" id="Facebook" name="Facebook"
                value="{{ old('Facebook', $website->Facebook) }}" required>
        </div>

        <!-- Nút Lưu thay đổi -->
        <button type="submit" class="btn btn-success">Lưu thay đổi</button>

        <!-- Nút Quay lại -->
        <a href="{{ route('admin.mainDashboard') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    // Thêm sự kiện sau khi cấu trúc HTML đã được load xong
    document.addEventListener("DOMContentLoaded", function() {
        const logoInput = document.getElementById("Logo");
        const previewLogo = document.getElementById("preview-logo");

        logoInput.addEventListener("change", function(event) {
            const file = event.target.files[0]; // Lấy file đã chọn

            if (file) {
                // Kiểm tra xem file có phải là hình ảnh hay không
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Hiển thị hình ảnh đã chọn
                        previewLogo.setAttribute("src", e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Vui lòng chọn file ảnh hợp lệ!");
                    // Reset input và giữ lại hình ảnh cũ
                    logoInput.value = "";
                    previewLogo.src = "{{ asset('img/' . $website->Logo) }}";
                }
            } else {
                // Nếu không chọn file, giữ nguyên hình ảnh cũ
                previewLogo.src = "{{ asset('img/' . $website->Logo) }}";
            }
        });
    });
</script>
