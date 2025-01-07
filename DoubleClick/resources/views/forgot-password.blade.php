@extends('layout')

@section('content')
<div class="container mt-5">
    <h2>Quên mật khẩu</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('forgotpass') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required style="text-transform: none;">
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Mật khẩu mới:</label>
            <div class="input-group">
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required style="text-transform: none;">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('new_password', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới:</label>
            <div class="input-group">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới" required style="text-transform: none;">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('new_password_confirmation', this)">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
    <script>
        function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

    </script>
</div>
@endsection
