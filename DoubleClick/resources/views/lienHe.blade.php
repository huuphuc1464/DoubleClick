@extends('layout')

@section('title', 'Liên hệ')

@section('content')

<section class="w-100"
    style="background-image: url('{{ asset('/img/background.jpg') }}');
        background-size: cover; background-repeat: no-repeat; background-position: center; border-radius: 10px; margin-top: 0;">


    <div class="bg-green-700 p-8 shadow-md rounded-md relative px-4 py-8">
    @if (session('success'))
    <div
        style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; text-align: center; font-size: 16px;">
        {{ session('success') }}
    </div>
@endif


        <h2 class="text-2xl font-bold mb-4">Bạn cần hỗ trợ?</h2>
        <p class="mb-4">
            Double Click rất hân hạnh được hỗ trợ bạn, hãy để lại thông tin cho chúng tôi nhé, <br>
            yêu cầu của bạn sẽ được phản hồi trong thời gian sớm nhất có thể.
        </p>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6" onsubmit="return confirmSubmit()">
            @csrf
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <input class="border border-black p-3 rounded-md"
                    style="border-color: black; height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Họ tên:" type="text" name="HoTen" value="{{ old('HoTen') }}" required />

                <input class="border border-black p-3 rounded-md"
                    style="border-color: black; height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Số điện thoại" type="text" name="SDT" id="SDT" value="{{ old('SDT') }}" required />

                <input class="border border-black p-3 rounded-md"
                    style="border-color: black; height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Email:" type="email" name="Email" id="Email" value="{{ old('Email') }}" required />
            </div>
            <textarea class="border border-black p-3 rounded-md w-full"
                style="border-color: black; height: 150px; width: 100%; max-width: 700px; margin: 10px;"
                placeholder="*Nội dung:" name="NoiDung" required>{{ old('NoiDung') }}</textarea>

            <div class="flex justify-end">
                <button class="bg-green-700 px-6 py-3 rounded-md transition duration-200" style="height: 40px; width: 130px; margin: 10px; font-size: 16px; font-weight: bold; text-align: center;
                        line-height: 10px; color: #000; background-color: #fff; border: 2px solid #000;" type="submit">
                    Gửi
                </button>

            </div>
        </form>

        <script>
            function confirmSubmit() {
                const phoneInput = document.getElementById('SDT');
                const phonePattern = /^0\d{9}$/; // Số điện thoại bắt đầu bằng 0 và có đúng 10 chữ số

                // Kiểm tra tính hợp lệ của số điện thoại
                if (!phonePattern.test(phoneInput.value)) {
                    alert('Số điện thoại phải bắt đầu bằng 0 và có đúng 10 ký tự.');
                    phoneInput.focus(); // Đưa con trỏ chuột về ô nhập số điện thoại
                    return false; // Ngăn không cho gửi form
                }

                const emailInput = document.getElementById('Email'); // Lấy ô nhập email
                const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; // Kiểm tra email kết thúc bằng @gmail.com

                // Kiểm tra email có hợp lệ không
                if (!emailPattern.test(emailInput.value)) {
                    alert('Địa chỉ email phải kết thúc bằng "@gmail.com". Vui lòng nhập lại.');
                    emailInput.focus(); // Đưa con trỏ chuột về ô nhập email
                    return false; // Ngăn không cho gửi form
                }

                // Hiển thị xác nhận trước khi gửi form
                return confirm("Bạn có chắc chắn muốn gửi không?");
            }

            document.addEventListener('DOMContentLoaded', function () {
                const phoneInput = document.getElementById('SDT');

                // Lắng nghe sự kiện nhập liệu trên ô số điện thoại
                phoneInput.addEventListener('input', function () {
                    if (!/^0\d{0,10}$/.test(this.value)) {
                        this.setCustomValidity('Số điện thoại phải bắt đầu bằng 0 và có tối đa 10 ký tự.');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            });
        </script>


    </div>
</section>

@endsection
