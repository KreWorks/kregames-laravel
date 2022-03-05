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
                @include('admin.users.form')
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
                // Datas for link table
                $tableLabels = App\Models\Link::$tableLabels;
                $datas = $entity->links;               
                $route = 'links';
                $redirectUrl  = route('admin.users.edit', $entity->id);
                ?>
                @include('admin._parts.table_list')

            </div>
        </div>
    </div>
    <!-- Add Modal Link-->
    <?php 
    // Dataas for add new link
    $name = 'link'; 
    $displayName = 'Link';
    $route = 'links';
    $linkable_type = App\Models\Link::$morphs['User']; 
    $linkable_id = $entity->id;
    $redirectUrl  = route('admin.users.edit', $entity->id);
    $extraDatas['linktypes'] = \App\Models\Linktype::all();
    $extraDatas['linkables'] = \App\Models\Link::getLinkables();
    unset($entity);
    ?>
    @include('admin._modals.add_modal')

    @include('admin._modals.delete_modal')
@endsection
