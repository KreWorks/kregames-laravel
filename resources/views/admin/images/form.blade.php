@extends('admin._layout.login_layout')

@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 col-ml-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Kép {{$action}}</h4>
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
                                <label for="type" class="col-form-label">Típus</label>
                                <select class="form-control" id="type" >
                                    <option value="0" {{$entity ? '': 'selected'}}>Válassz</option>
                                    @foreach($types as $value => $type)
                                        @if($entity && $entity->type == $value)
                                        <option value="{{$value}}" selected>{{$type}}</option>
                                        @else 
                                        <option value="{{$value}}">{{$type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="imageable_type" class="col-form-label">Szülő típus</label>
                                <select class="form-control" id="imageable_type" name="imageable_type">
                                    <option value="0" {{$entity ? '' : 'selected'}}>Válassz</option>
                                    @foreach($morphTypes as $value => $morph)
                                        @if ($entity && $entity->imageable_type == $value)
                                        <option value="{{$value}}" selected>{{$morph}}</option>
                                        @else
                                        <option value="{{$value}}">{{$morph}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="publish_date" class="col-form-label">Szülő</label>
                                @if ($entity && $entity->imageable_type == 'App\Models\Game')
                                <select class="form-control" id="imageable_id" name="imageable_id">
                                    <option value="0" {{$entity ? '' : 'selected'}}>Válassz</option>
                                    @foreach($morphs['games'] as $game)
                                        @if ($entity && $entity->imageable_id == $game->id)
                                        <option value="{{$game->id}}" selected>{{$game->name}}</option>
                                        @else
                                        <option value="{{$game->id}}">{{$game->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @elseif ($entity && $entity->imageable_type == 'App\Models\Jam')
                                <select class="form-control" id="imageable_id" name="imageable_id">
                                    <option value="0" {{$entity ? '' : 'selected'}}>Válassz</option>
                                    @foreach($morphs['jams'] as $jam)
                                        @if ($entity && $entity->imageable_id == $jam->id)
                                        <option value="{{$jam->id}}" selected>{{$jam->name}}</option>
                                        @else
                                        <option value="{{$jam->id}}">{{$jam->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @endif
                            </div>

                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary col-6">Mentés</button>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group col-lg-12">
                                <label for="icon" class="form-label">Kép</label>
                                <input class="form-control" type="file" id="icon" name="icon">
                            </div>
                            @if ($entity)
                            <div class="col-lg-12">
                                <img class="col-lg-6" src="/{{ $entity->path }}">
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