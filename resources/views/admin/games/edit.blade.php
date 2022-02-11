@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Játék szerkesztése: {{ $entity->name }}</span>
                </div>
            </div>
            <div class="card-body">
            <?php 
            $tableLabels = App\Models\Game::$tableLabels;
            ?>
                @include('admin.games.form')
            </div>
        </div>
    </div>

@endsection
