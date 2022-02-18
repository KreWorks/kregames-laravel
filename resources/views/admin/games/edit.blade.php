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
                $linkable_type = "App\Models\Game"; 
                $linkable_id = $entity->id;
                $route = 'links';
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
    $redirectRoute  = route('admin.games.edit', $entity->id);
    $extraDatas['linktypes'] = \App\Models\Linktype::all();
    $extraDatas['morphs'] = \App\Models\Link::$morphs;
    $extraDatas['linkables'] = \App\Models\Link::getLinkables();
    unset($entity);
    ?>
    @include('admin._modals.add_modal');

    @include('admin._modals.delete_modal');
@endsection
