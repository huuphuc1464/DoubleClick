@extends('Profile.sublayout')

@section('css_sub')
{{-- <link rel="stylesheet" href="{{ asset('css/.css') }}"> --}}
<style>
    .table th,
    .table td {
        vertical-align: middle;
    }

    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    .text-center {
        text-align: center;
    }

</style>

@endsection

@section('content_sub')
<div class="container mt-4">
    <h5>
        Nhận xét của tôi
    </h5>
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
                <th scope="col">
                    Đánh giá
                </th>
                <th scope="col">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" class="text-center">
                    1
                </th>
                <td>
                    <img alt="Book cover of Chiến Binh Cầu Vồng (Tái Bản 2020)" class="img-fluid me-2" height="75" src="https://storage.googleapis.com/a1aa/image/lt6D5CapKkZENVsJJkBJ8IJJqDoXVrQ86VAtEEpLsLkSQ7fJA.jpg" width="50" />
                    Chiến Binh Cầu Vồng (Tái Bản 2020)
                </td>
                <td class="text-center">
                    5
                </td>
                <td>
                    Sách hay và ý nghĩa
                </td>
                <td class="text-center">
                    <a class="text-danger" href="#">
                        <i class="fas fa-trash-alt">
                        </i>
                    </a>
                </td>
            </tr>
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
</div>
@endsection
