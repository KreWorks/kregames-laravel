
@foreach($datas as $index => $data)
    @if($index == 0)
    <div class="row">
    @endif
        <div class="col">
            <div class="card border" style="width: 18rem;align:center;">
                <img src="/{{$data->path}}" class="card-img-top" alt="{{$data->title}}" style="width:80%;margin:20px auto 0px;">
                <div class="card-body" >
                    <h5 class="card-title text-center">{{$data->title}}</h5>
                    <div class="btn btn-danger "
                        data-toggle="modal" data-target="#deleteModal" onclick="deleteConfirm('{{ route('admin.images.destroy', $data->id) }}',
                            `{{$data->deleteString}}`, '{{$redirectUrl}}');">
                        <i class="fa fa-trash-can fa-lg"></i>
                    </div>
                </div>
            </div>
        </div>

    @if($index % 5 == 0 && $index != count($datas) -1)
    </div>
    <div class="row">
    @endif
    @if($index == count($datas)-1)
    </div>
    @endif
@endforeach

