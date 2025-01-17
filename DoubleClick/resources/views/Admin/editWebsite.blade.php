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

        <!-- Tiêu đề -->
        <div class="mb-3">
            <label for="Title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="Title" name="Title"
                value="{{ old('Title', $website->Title) }}">
        </div>

        <!-- Phụ đề -->
        <div class="mb-3">
            <label for="SubTitle" class="form-label">Phụ đề</label>
            <input type="text" class="form-control" id="SubTitle" name="SubTitle"
                value="{{ old('SubTitle', $website->SubTitle) }}">
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="MoTa" class="form-label">Mô tả</label>
            <textarea class="form-control" id="MoTa" name="MoTa" rows="3">{{ old('MoTa', $website->MoTa) }}</textarea>
        </div>

        <!-- Lời mời gọi -->
        <div class="mb-3">
            <label for="MoiGoi" class="form-label">Lời mời gọi</label>
            <input type="text" class="form-control" id="MoiGoi" name="MoiGoi"
                value="{{ old('MoiGoi', $website->MoiGoi) }}">
        </div>

        <!-- Logo -->
        <div class="mb-3">
            <label for="Logo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="Logo" name="Logo" accept="image/*">
            <img id="preview-logo" src="{{ asset('img/' . $website->Logo) }}" alt="Logo hiện tại"
                class="img-thumbnail mt-2" width="150">
        </div>

        <!-- Ảnh -->
        <div class="mb-3">
            <label for="Image" class="form-label">Ảnh nền</label>
            <input type="file" class="form-control" id="Image" name="Image" accept="image/*">
            <img id="preview-image" src="{{ asset('img/website/' . $website->Image) }}" alt="Ảnh nền hiện tại"
                class="img-thumbnail mt-2" width="150">
        </div>

        <!-- Video -->
        <div class="mb-3">
            <label for="Video" class="form-label">Video</label>
            <input type="file" class="form-control" id="Video" name="Video" accept="video/*">
        </div>

        <!-- Facebook -->
        <div class="mb-3">
            <label for="Facebook" class="form-label">Facebook</label>
            <input type="text" class="form-control" id="Facebook" name="Facebook"
                value="{{ old('Facebook', $website->Facebook) }}">
        </div>

        <!-- Instagram -->
        <div class="mb-3">
            <label for="Instagram" class="form-label">Instagram</label>
            <input type="text" class="form-control" id="Instagram" name="Instagram"
                value="{{ old('Instagram', $website->Instagram) }}">
        </div>

        <!-- Twitter -->
        <div class="mb-3">
            <label for="Twitter" class="form-label">Twitter</label>
            <input type="text" class="form-control" id="Twitter" name="Twitter"
                value="{{ old('Twitter', $website->Twitter) }}">
        </div>

        <!-- Phản hồi khách hàng -->
        <div class="mb-3">
            <h4>Phản hồi khách hàng</h4>

            <!-- Phản hồi khách hàng 1 -->
            <div class="mb-3">
                <label for="TenKhach1" class="form-label">Tên khách hàng 1</label>
                <input type="text" class="form-control" id="TenKhach1" name="TenKhach1"
                    value="{{ old('TenKhach1', $website->TenKhach1) }}">
            </div>
            <div class="mb-3">
                <label for="PhanHoi1" class="form-label">Phản hồi 1</label>
                <textarea class="form-control" id="PhanHoi1" name="PhanHoi1" rows="3">{{ old('PhanHoi1', $website->PhanHoi1) }}</textarea>
            </div>

            <!-- Phản hồi khách hàng 2 -->
            <div class="mb-3">
                <label for="TenKhach2" class="form-label">Tên khách hàng 2</label>
                <input type="text" class="form-control" id="TenKhach2" name="TenKhach2"
                    value="{{ old('TenKhach2', $website->TenKhach2) }}">
            </div>
            <div class="mb-3">
                <label for="PhanHoi2" class="form-label">Phản hồi 2</label>
                <textarea class="form-control" id="PhanHoi2" name="PhanHoi2" rows="3">{{ old('PhanHoi2', $website->PhanHoi2) }}</textarea>
            </div>

            <!-- Phản hồi khách hàng 3 -->
            <div class="mb-3">
                <label for="TenKhach3" class="form-label">Tên khách hàng 3</label>
                <input type="text" class="form-control" id="TenKhach3" name="TenKhach3"
                    value="{{ old('TenKhach3', $website->TenKhach3) }}">
            </div>
            <div class="mb-3">
                <label for="PhanHoi3" class="form-label">Phản hồi 3</label>
                <textarea class="form-control" id="PhanHoi3" name="PhanHoi3" rows="3">{{ old('PhanHoi3', $website->PhanHoi3) }}</textarea>
            </div>

            <!-- Phản hồi khách hàng 4 -->
            <div class="mb-3">
                <label for="TenKhach4" class="form-label">Tên khách hàng 4</label>
                <input type="text" class="form-control" id="TenKhach4" name="TenKhach4"
                    value="{{ old('TenKhach4', $website->TenKhach4) }}">
            </div>
            <div class="mb-3">
                <label for="PhanHoi4" class="form-label">Phản hồi 4</label>
                <textarea class="form-control" id="PhanHoi4" name="PhanHoi4" rows="3">{{ old('PhanHoi4', $website->PhanHoi4) }}</textarea>
            </div>
        </div>

        <!-- Nút Lưu thay đổi -->
        <button type="submit" class="btn btn-success">Lưu thay đổi</button>

        <!-- Nút Quay lại -->
        <a href="{{ route('admin.mainDashboard') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const logoInput = document.getElementById("Logo");
        const imageInput = document.getElementById("Image");
        const previewLogo = document.getElementById("preview-logo");
        const previewImage = document.getElementById("preview-image");

        const previewFile = (input, preview) => {
            input.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert("Vui lòng chọn file ảnh hợp lệ!");
                }
            });
        };

        previewFile(logoInput, previewLogo);
        previewFile(imageInput, previewImage);
    });
</script>
