@extends('layout')

@section('title', 'Liên hệ')

@section('content')

<section
class="container mx-auto px-4 py-8 mt-5"
    style="background-image: url('{{ asset('/img/background.png') }}');
    width: 100%; background-size: cover; background-repeat: no-repeat; background-position: center; border-radius: 10px;"
>
    <div class="bg-white p-8 shadow-md rounded-md relative">

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
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <input
                    class="border border-gray-300 p-3 rounded-md"
                    style="height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Họ tên:"
                    type="text"
                    name="HoTen"
                    value="{{ old('HoTen') }}"
                    required />

                <input
                    class="border border-gray-300 p-3 rounded-md"
                    style="height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Số điện thoại"
                    type="text"
                    name="SDT"
                    value="{{ old('SDT') }}"
                    required />

                <input
                    class="border border-gray-300 p-3 rounded-md"
                    style="height: 50px; width: 100%; max-width: 300px; margin: 10px;"
                    placeholder="*Email:"
                    type="email"
                    name="Email"
                    value="{{ old('Email') }}"
                    required />
            </div>

            <textarea
                class="border border-gray-300 p-3 rounded-md w-full"
                style="height: 150px; width: 100%; max-width: 700px; margin: 10px;"
                placeholder="*Nội dung:"
                name="NoiDung"
                required>{{ old('NoiDung') }}</textarea>

            <div class="flex justify-end">
                <button
                    class="bg-green-700 text-white px-6 py-3 rounded-md transition duration-200"
                    style="height: 40px; width: 100%; max-width: 150px; margin: 10px;"
                    type="submit">
                    Gửi
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
