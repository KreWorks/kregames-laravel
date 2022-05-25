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
                $redirectUrl  = route('admin.games.edit', $entity->id);
                echo count($categories);
                echo ($categories[0]->name);
                ?>

                
                @include('admin._parts.table_list')

            </div>
        </div>
        @endif
    </div>

    <!-- Add Modal Link-->
    <?php 
    // Dataas for add new link
    $name = 'link'; 
    $displayName = 'Link';
    $route = 'links';
    $linkable_type = App\Models\Link::$morphs['Game']; 
    $linkable_id = $entity->id;
    $redirectUrl  = route('admin.games.edit', $entity->id);
    $extraDatas['linktypes'] = \App\Models\Linktype::all();
    $extraDatas['linkables'] = \App\Models\Link::getLinkables();
    unset($entity);
    ?>
    @include('admin._modals.add_modal');

    @include('admin._modals.delete_modal');
@endsection
