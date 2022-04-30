@extends('admin._layout.login_layout')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Jam szerkesztése: {{ $entity->name }}</span>
                </div>
            </div>
            <div class="card-body">
                @include('admin.jams.form')
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Értékelési kategória lista</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addLinkButton"
                            onclick="openModal('categoryJamForm')">
                        Új értékelési kategória hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php 
                // Datas for category table
                $tableLabels = App\Models\Category::$pivotLabels;
                $datas = $entity->categories;               
                $route = 'category_jam';
                $jam = $entity;
                $redirectUrl  = route('admin.jams.edit', $entity->id);
                ?>
                @include('admin._parts.table_list')

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
                // Datas for link table
                $tableLabels = App\Models\Link::$tableLabels;
                $datas = $entity->links;               
                $route = 'links';
                $redirectUrl  = route('admin.jams.edit', $entity->id);
                ?>
                @include('admin._parts.table_list')

            </div>
        </div>
    </div>
    <!-- Add Modal for Category -->
    <?php 
    $jam = $entity;
    unset($entity);
    $name = 'categoryJam'; 
    $displayName = 'Értékelési kategória';
    $route = 'category_jam';
    $jam_id = $jam->id;
    $redirectUrl  = route('admin.jams.edit', $jam->id);
    $extraDatas['categories'] = \App\Models\Category::all();
    $extraDatas['jams'] = \App\Models\Jam::all();
    ?>
    @include('admin._modals.add_modal')
    <!-- Add Modal for Link -->
    <?php 
    $name = 'link'; 
    $displayName = 'Link';
    $route = 'links';
    $linkable_type = App\Models\Link::$morphs['Jam']; 
    $linkable_id = $jam->id;
    $redirectUrl  = route('admin.jams.edit', $jam->id);
    $extraDatas['linktypes'] = \App\Models\Linktype::all();
    $extraDatas['linkables'] = \App\Models\Link::getLinkables();
    ?>
    @include('admin._modals.add_modal')

    @include('admin._modals.delete_modal')
@endsection
