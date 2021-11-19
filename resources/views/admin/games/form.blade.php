@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Játék létrehozása</h4>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-6">
                        @if ($entity)
                        <form method="POST" action="{{ route($formAction, $entity->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                        @else 
                        <form method="POST" action="{{ route($formAction) }}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div class="form-group col-lg-12">
                                <label for="name" class="col-form-label">Név</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->name : '' }}" id="name" name="name" onkeyup="document.getElementById('slug').value = createSlug(value)">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="slug" class="col-form-label">Slug</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->slug : '' }}" id="slug" name="slug">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="publish_date" class="col-form-label">Megjelenés dátuma</label>
                                <input class="form-control" type="datetime-local" value="{{ $entity ? preg_replace('/ /', 'T', $entity->publish_date) : time() }}" id="publish_date" name="publish_date">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="jam_id" class="col-form-label">Jam</label>
                                <select class="form-control" id="jam_id" name="jam_id">
                                    <option id="0" {{ $entity ? '' : 'selected'}}>Nincs jam</option>
                                    @foreach($jams as $jam)
                                        @if($entity && $jam == $entity->jam)
                                        <option id="{{$jam->id}}" selected>{{$jam->name}}</option>
                                        @else
                                        <option id="{{$jam->id}}">{{$jam->name}}</option>
                                        @endif
                                    @endforeach
                                <select>
                            </div>
                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary col-6">Mentés</button>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group col-lg-12">
                                <label for="icon" class="form-label">Logó</label>
                                <input class="form-control" type="file" id="icon" name="icon">
                            </div>
                            @if ($entity)
                            <div class="col-lg-12">
                                <img class="col-lg-3" src="/{{ $entity->__get('iconPath') }}">
                            </div>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main content area end -->
@endsection