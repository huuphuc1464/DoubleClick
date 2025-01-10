@extends('layout')

@section('title', 'Liên hệ')

@section('content')

<section class="w-100"
    style="background-image: url('{{ asset('/img/background.jpg') }}');
    background-size: cover; background-repeat: no-repeat; background-position: center; border-radius: 10px; margin-top: 0;">


    <div class="bg-green-700 p-8 shadow-md rounded-md relative px-4 py-8">

        @if (session('success'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
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
                    style="border-color: black; height: 50px; width: 100%; max-width: 300px; margin: 30px;"
                    placeholder="*Email:" type="email" name="Email" value="{{ old('Email') }}" required />
            </div>

            <textarea class="border border-black p-3 rounded-md w-full"
                style="border-color: black; height: 150px; width: 100%; max-width: 700px; margin: 10px;"
                placeholder="*Nội dung:" name="NoiDung" required>{{ old('NoiDung') }}</textarea>

            <div class="flex justify-end">
                <button class="bg-green-700 px-6 py-3 rounded-md transition duration-200"
                    style="height: 40px; width: 130px; margin: 10px; font-size: 16px; font-weight: bold; text-align: center;
                    line-height: 10px; color: #000; background-color: #fff; border: 2px solid #000;"
                    type="submit">
                    Gửi
                </button>






            </div>
        </form>

        <script>
            function confirmSubmit() {
                const phoneInput = document.getElementById('SDT');
                const phonePattern = /^0\d{10}$/;
                if (!phonePattern.test(phoneInput.value)) {
                    alert('Số điện thoại phải bắt đầu bằng 0 và có đúng 11 ký tự.');
                    phoneInput.focus();
                    return false;
                }

                const isConfirmed = confirm("Bạn có chắc chắn muốn gửi không?");
                return isConfirmed;
            }

            document.addEventListener('DOMContentLoaded', function () {
                const phoneInput = document.getElementById('SDT');

                phoneInput.addEventListener('input', function () {
                    if (!/^0\d{0,10}$/.test(this.value)) {
                        this.setCustomValidity('Số điện thoại phải bắt đầu bằng 0 và có đúng 11 ký tự.');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            });
        </script>

    </div>
</section>

@endsection
