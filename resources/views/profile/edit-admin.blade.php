@extends('layouts.admin')

@section('page_title', 'Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary card-outline">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Profile Information</h3>
                        <p class="text-muted mb-0">Update your account profile information and email address.</p>
                    </div>
                    <a href="{{ url()->previous() ?? route('dashboard') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form-admin')
                </div>
            </div>

            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form-admin')
                </div>
            </div>

            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">Delete Account</h3>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form-admin')
                </div>
            </div>
        </div>
    </div>
@endsection
