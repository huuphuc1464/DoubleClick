@extends('Profile.sublayout')

@section('css_sub')

@endsection

@section('content_sub')
<h2>Thông tin cá nhân</h2>
<p>Quản lý thông tin cá nhân để bảo mật tài khoản</p>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="MaTK" value="{{ $account -> MaTK }}">
    <div class="form-item">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="Username" value="{{ $account -> Username }}" disabled class="form-control">

    </div>
    <div class="form-item">
        <label for="fullname">Họ và tên</label>
        <input type="text" id="fullname" name="TenTK" value="{{ $account -> TenTK }}" class="form-control">

    </div>
    <div class="form-item">
        <label for="email">Email</label>
        <input type="email" id="email" name="Email" value="{{ $account -> Email }}" class="form-control">

    </div>
    <div class="form-item">
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="DiaChi" value="{{ $account -> DiaChi }}" class="form-control">

    </div>
    <div class="form-item">
        <label for="phone">Số điện thoại</label>
        <input type="text" id="phone" name="SDT" value="{{ $account -> SDT }}" class="form-control">

    </div>

    <div class="form-item gender-group">
        <label>Giới tính</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="male" name="GioiTinh" value="Nam" {{ $account->GioiTinh === 'Nam' ? 'checked' : '' }}>
            <label class="form-check-label" for="male">Nam</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="female" name="GioiTinh" value="Nữ" {{ $account->GioiTinh === 'Nữ' ? 'checked' : '' }}>
            <label class="form-check-label" for="female">Nữ</label>
        </div>
    </div>

    <div class="form-item profile-picture">
        <label for="profile-pic">Ảnh đại diện</label>
        <div class="profile-pic-container">
            <!-- Hiển thị ảnh đại diện -->
            <img id="profile-pic-preview" src="{{ asset('/storage/img/Profile/' . ($account->Image ?? 'default.jpg')) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
            <!-- Input để chọn ảnh -->
            <input type="file" id="profile-pic" name="Image" accept="image/jpeg, image/png" style="display: none;" onchange="previewImage(event)">
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile-pic').click();">
                Thay đổi ảnh
            </button>
        </div>
    </div>


    <div class="form-item dob-group">
        <label for="dob">Ngày sinh</label>
        <select id="dob-day" name="dob_day" class="form-control">

            <option value="">Ngày</option>
        </select>
        <select id="dob-month" name="dob_month" class="form-control">

            <option value="">Tháng</option>
        </select>
        <select id="dob-year" name="dob_year" class="form-control">
            <option value="">Năm</option>
        </select>
    </div>
    <div class="form-item submit-group">
        <button type="submit">Lưu thay đổi</button>
    </div>

</form>

<script>
    // Lắng nghe sự kiện thay đổi trên input file
    document.getElementById('profile-pic').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Lấy file đã chọn

        if (file) {
            // Kiểm tra định dạng và kích thước tệp
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                alert("Chỉ chấp nhận định dạng .JPEG hoặc .PNG.");
                return;
            }

            if (file.size > 1 * 1024 * 1024) { // 1 MB
                alert("Dung lượng file vượt quá 1 MB.");
                return;
            }

            // Tạo URL cho file mới
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hiển thị ảnh mới trong thẻ <img>
                document.getElementById('profile-pic-preview').src = e.target.result;
            };
            reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
        }
    });

</script>

<script>
    // Hàm khởi tạo các giá trị dropdown
    function populateDateDropdowns() {
        // Tạo các giá trị ngày (1-31)
        const daySelect = document.getElementById('dob-day');
        for (let i = 1; i <= 31; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }

        // Tạo các giá trị tháng (1-12)
        const monthSelect = document.getElementById('dob-month');
        for (let i = 1; i <= 12; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            monthSelect.appendChild(option);
        }

        // Tạo các giá trị năm (1900-2024)
        const yearSelect = document.getElementById('dob-year');
        const currentYear = new Date().getFullYear();
        for (let i = 1900; i <= currentYear; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            yearSelect.appendChild(option);
        }
    }

    // Hàm điền ngày sinh từ định dạng yyyy-mm-dd
    function fillDateOfBirth(dateString) {
        const [year, month, day] = dateString.split('-').map(Number); // Tách theo dấu "-"
        document.getElementById('dob-day').value = day || "";
        document.getElementById('dob-month').value = month || "";
        document.getElementById('dob-year').value = year || "";
    }

    // Khởi tạo dropdown và điền giá trị
    populateDateDropdowns();

    // Lấy giá trị ngày sinh từ PHP
    const ngaySinh = @json($account - > NgaySinh);

    // Điền vào dropdown
    if (ngaySinh) {
        fillDateOfBirth(ngaySinh);
    } else {
        console.log("Ngày sinh không tồn tại hoặc null.");
    }

</script>


@endsection
