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
                @include('admin.games.form')
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Link lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addLinkButton"
                            onclick="openModal('linkForm')">
                        Új link hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php 
                $tableLabels = App\Models\Link::$tableLabels;
                $datas = $entity->links;
                $linkable_type = "\App\Models\Game"; 
                $linkable_id = $entity->id;
                ?>
                @include('admin._parts.table_list')

            </div>
        </div>
    </div>


     <!-- Add Modal Link-->
     <?php 
    $name = 'link'; 
    $displayName = 'Link';
    $route = 'links';
    $extraDatas['linktypes'] = \App\Models\LinkType::all();
    ?>
    @include('admin._modals.add_modal');

@endsection
