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
                // Datas for link table
                $tableLabels = App\Models\Link::$tableLabels;
                $datas = $entity->links;               
                $route = 'links';
                $redirectUrl  = route('admin.games.edit', $entity->id);
                ?>
                @include('admin._parts.table_list')

            </div>
        </div>
        <hr/>
        @if($entity->jam !== null)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <span class="col-md-8 my-auto">Értékelések</span>
                </div>
            </div>
            <div class="card-body">
                <?php 
                // Datas for rating table
                $tableLabels = App\Models\Rating::$tableLabelsForParent;
                $datas = App\Models\Rating::where('game_id', '=', $entity->id)->get();
                $categories = $entity->categories;           
                $route = 'ratings';
                $game = $entity;
                $redirectUrl  = route('admin.games.edit', $entity->id);
                ?>
                @include('admin.ratings.table_list_for_game_edit')

            </div>
        </div>
        <hr>
        @endif
        <div class="card">
            <div class="card-header bg-primary text-white">
            <div class="row">
                    <span class="col-md-8 my-auto">Képek</span>
                    <button type="button" class="btn btn-warning col-md-3 float-right" id="addImageButton"
                            onclick="openModal('imageForm')">
                        Új kép hozzáadása
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php 
                // Datas for images table
                $datas = App\Models\Image::where('imageable_id', '=', $entity->id)->where('imageable_type', '=', 'App\Models\Game')->get();
                $route = 'images';
                $game = $entity;
                $imageable_type = App\Models\Image::$morphs['Game'];
                $imageable_id = $entity->id;
                $redirectUrl  = route('admin.games.edit', $entity->id);
                ?>
                @include('admin.images.table_list')

            </div>
        </div>
    </div>

    <!-- Add Modal Link-->
    <?php 
    $game = $entity;
    unset($entity);
    // Dataas for add new link
    $name = 'link'; 
    $displayName = 'Link';
    $route = 'links';
    $linkable_type = App\Models\Link::$morphs['Game']; 
    $linkable_id = $game->id;
    $redirectUrl  = route('admin.games.edit', $game->id);
    $extraDatas['linktypes'] = \App\Models\Linktype::all();
    $extraDatas['linkables'] = \App\Models\Link::getLinkables();
    ?>
    @include('admin._modals.add_modal');
    <?php 
    // Dataas for add new image
    $name = 'image'; 
    $displayName = 'Kép';
    $route = 'images';
    $imageable_type = App\Models\Image::$morphs['Game']; 
    $imageable_id = $game->id;
    $redirectUrl  = route('admin.games.edit', $game->id);
    $extraDatas['imagetypes'] = \App\Models\Image::getImageTypes();
    $extraDatas['imageables'] = \App\Models\Image::getImageables();
    ?>
    @include('admin._modals.add_modal');


    @include('admin._modals.delete_modal');
@endsection
