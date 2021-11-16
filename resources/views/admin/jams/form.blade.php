@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Jam létrehozása</h4>
                    </div>
                    <div class="card-body d-flex">
                        <div class="col-6">
                        <form method="post" action="{{ route('admin.jams.store') }}" enctype="multipart/form-data">
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
                                <label for="entries" class="col-form-label">Indulók</label>
                                <input class="form-control" type="number" value="{{ $entity ? $entity->entries : '' }}" id="entries" name="entries">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="theme" class="col-form-label">Téma</label>
                                <input class="form-control" type="text" value="{{ $entity ? $entity->theme : '' }}" id="theme" name="theme">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="start_date" class="col-form-label">Kezdés</label>
                                <input class="form-control" type="datetime-local" value="{{ $entity ? $entity->start_date : time() }}" id="start_date" name="start_date">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="end_date" class="col-form-label">Vég</label>
                                <input class="form-control" type="datetime-local" value="{{ $entity ? $entity->end_date : time() }}" id="end_date" name="end_date">
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
                            <div class="col-lg-12">
                                <img class="col-lg-6" src="{{ asset('/images/games/pothole-panic/icon.GIF') }}">
                            </div>
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