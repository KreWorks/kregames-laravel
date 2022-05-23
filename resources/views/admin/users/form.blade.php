@if (isset($entity))
<form method="POST" action="{{ route('admin.users.update', $entity->id) }}" enctype="multipart/form-data" name="user-form" id="user-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.users.store')}}" enctype="multipart/form-data" name="user-form" id="user-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->   
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->name : '' }}" id="name" name="name">
            </div>
            <div class="form-group col-lg-12">
                <label for="username" class="col-form-label">Felhaszánlónév</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->username : '' }}" id="username" name="username">
            </div>
            <div class="form-group col-lg-12">
                <label for="email" class="col-form-label">Email</label>
                <input class="form-control" type="email" value="{{ isset($entity) ? $entity->email : '' }}" id="email" name="email">
            </div>
            <div class="form-group col-lg-12">
                <label for="password" class="col-form-label">Jelszó</label>
                <input class="form-control" type="password" value="" id="password" name="password">
            </div>
            <div class="form-group col-lg-12">
                <label for="password_again" class="col-form-label">Jelszó ismét</label>
                <input class="form-control" type="password" value="" id="password_again" name="password_again">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="avatar" class="form-label">Avatár</label>
                <input class="form-control" type="file" id="avatar" name="avatar">
            </div>
            <div class="col-lg-12">
                <img class="col-lg-3" src="/{{ isset($entity) ? $entity->avatar_path : '' }}">
            </div>

        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.users.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary">Mentés</button>
    </div>
</form>
