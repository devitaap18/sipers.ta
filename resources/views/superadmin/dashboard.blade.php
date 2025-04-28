@extends('layouts.app')

@section('title', 'Dashboard Superadmin')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Superadmin</h2>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Statistik Users -->
        <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-users text-info"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Users</p>
                                <h4 class="card-title">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Users
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Roles -->
        <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-user-shield text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Roles</p>
                                <h4 class="card-title">{{ $totalRoles }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Roles
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Menus -->
        <div class="col-lg-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center icon-warning">
                                <i class="fa fa-bars text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Menus</p>
                                <h4 class="card-title">{{ $totalMenus }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        Total Menu
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection