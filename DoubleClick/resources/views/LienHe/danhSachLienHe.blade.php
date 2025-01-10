@extends('Admin.layout')

@section('title', 'Thông tin liên hệ khách hàng')
@section('subtitle', 'Liên hệ')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Danh sách liên hệ</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($contacts->isEmpty())
                                <p
                                    style="text-align: center; font-size: 24px; color: red; font-weight: bold; margin-top: 130px;">
                                    Chưa có khách hàng nào gửi liên hệ đến!
                                </p>
                            @else
                                <table class="table table-bordered w-100" style="border: 2px solid black;">
                                    <thead
                                        style="background-color: #d3d3d3; color: black; text-align: center; border: 2px solid black;">
                                        <tr>
                                            <th style="border: 2px solid LightGray; width: 50px;  white-space: nowrap;">ID
                                            </th>
                                            <th style="border: 2px solid LightGray; width: 150px; white-space: nowrap;">Họ
                                                Tên</th>
                                            <th style="border: 2px solid LightGray; width: 200px; white-space: nowrap;">
                                                Email</th>
                                            <th style="border: 2px solid LightGray; width: 100px; white-space: nowrap;">SĐT
                                            </th>
                                            <th style="border: 2px solid LightGray; width: 300px; white-space: nowrap;">Nội
                                                dung
                                            </th>
                                            <th style="border: 2px solid LightGray; width: 105px; white-space: nowrap;">
                                                Trạng thái
                                            </th>
                                            <th style="border: 2px solid LightGray; width: 200px; white-space: nowrap;">Hành
                                                động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td style="border: 2px solid LightGray; width: 50px;  white-space: nowrap;">
                                                    {{ Str::limit($contact->MaLienHe, 10) }}
                                                </td>
                                                <td style="border: 2px solid LightGray; width: 150px; white-space: nowrap;">
                                                    {{ Str::limit($contact->HoTen, 13) }}
                                                </td>
                                                <td style="border: 2px solid LightGray; width: 200px; white-space: nowrap;">
                                                    {{ Str::limit($contact->Email, 20) }}
                                                </td>
                                                <td style="border: 2px solid LightGray; width: 100px; white-space: nowrap;">
                                                    {{ $contact->SDT }}
                                                </td>
                                                <td style="border: 2px solid LightGray; width: 300px; white-space: nowrap;">
                                                    {{ Str::limit($contact->NoiDung, 35) }}
                                                </td>
                                                <td style="border: 2px solid LightGray; width: 105px; white-space: nowrap;">

                                                    @if ($contact->TrangThai == 1)
                                                        <span class="badge bg-success">Đã xử lý</span>
                                                    @elseif ($contact->TrangThai == 0)
                                                        <span class="badge bg-warning">Đang xử lý</span>
                                                    @else
                                                        <span class="badge bg-danger">Chưa xử lý</span>
                                                    @endif
                                                </td>

                                                <td style="border: 2px solid LightGray; width: 200px; white-space: nowrap;">
                                                    <a href="{{ route('contacts.show', $contact->MaLienHe) }}"
                                                        class="btn btn-info btn-sm">Xem</a>
                                                    <a href="{{ route('contacts.update-status', $contact->MaLienHe) }}"
                                                        class="btn btn-warning btn-sm">Cập nhật</a>
                                                    <form action="{{ route('contacts.destroy', $contact->MaLienHe) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?')">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $contacts->links('pagination::bootstrap-4') }}
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
