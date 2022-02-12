@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Felhasználó szerkesztése: {{ $entity->name }}</span>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\User::$tableLabels;
            ?>
                @include('admin.users.form')
            </div>
        </div>
    </div>

@endsection