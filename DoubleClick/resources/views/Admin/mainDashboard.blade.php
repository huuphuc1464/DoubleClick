@extends('Admin.layout')

@section('title', 'Quản lý Website')

@section('content')
    <!-- Hiển thị thông báo thành công -->
    <div class="container mt-4">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('activeTab', 'dashboard') === 'dashboard' ? 'active' : '' }}"
                    id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab"
                    aria-controls="dashboard"
                    aria-selected="{{ session('activeTab', 'dashboard') === 'dashboard' ? 'true' : 'false' }}">
                    Thống kê
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('activeTab') === 'website' ? 'active' : '' }}" id="website-tab"
                    data-bs-toggle="tab" data-bs-target="#website" type="button" role="tab" aria-controls="website"
                    aria-selected="{{ session('activeTab') === 'website' ? 'true' : 'false' }}">
                    Chỉnh sửa Website
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="myTabContent">
            <!-- Dashboard Tab -->
            <div class="tab-pane fade {{ session('activeTab', 'dashboard') === 'dashboard' ? 'show active' : '' }}"
                id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                @include('Admin.dashboard') <!-- File thống kê -->
            </div>

            <!-- Website Info Tab -->
            <div class="tab-pane fade {{ session('activeTab') === 'website' ? 'show active' : '' }}" id="website"
                role="tabpanel" aria-labelledby="website-tab">
                @include('Admin.editWebsite') <!-- File chỉnh sửa website -->
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navDashboard = document.getElementById('dashboard-tab');
            const navEditWebsite = document.getElementById('website-tab');
            const dashboard = document.getElementById('dashboard');
            const website = document.getElementById('website');

            navDashboard.addEventListener('click', function() {
                if (!navDashboard.classList.contains('active')) {
                    navEditWebsite.classList.remove('active');
                    navDashboard.classList.add('active');
                }
                if (!dashboard.classList.contains('show')) {
                    dashboard.classList.add('show', 'active');
                    website.classList.remove('show', 'active');
                }
            })
            navEditWebsite.addEventListener('click', function() {
                if (!navEditWebsite.classList.contains('active')) {
                    navEditWebsite.classList.add('active');
                    navDashboard.classList.remove('active');
                }
                if (!website.classList.contains('show')) {
                    website.classList.add('show', 'active');
                    dashboard.classList.remove('show', 'active');
                }
            })

        });

        // Đặt lại tab khi tải lại trang
        // const activeTab = sessionStorage.getItem('activeTab');
        // if (activeTab) {
        //     const tabToActivate = document.getElementById(activeTab);
        //     if (tabToActivate) {
        //         tabToActivate.classList.add('show', 'active');
        //     }
        // }
    </script>

@endsection
