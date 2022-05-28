@if (isset($entity))
<form method="POST" action="{{ route('admin.links.update', $entity->id) }}" enctype="multipart/form-data" name="link-form" id="link-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.links.store')}}" enctype="multipart/form-data" name="link-form" id="link-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-lg-12">
                <label for="link" class="col-form-label">Link</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->link : '' }}" id="link" name="link">
            </div>
            <div class="form-group col-lg-12">
                <label for="display_text" class="col-form-label">Megjelenő szöveg</label>
                <input class="form-control" type="text" value="{{ isset($entity) ? $entity->display_text : ''}}" id="display_text" name="display_text">
            </div>
            @if (isset($entity) || (!isset($linkable_id) && !isset($linkable_type)))
            <div class="form-group col-lg-12">
                <label for="linkable_type" class="col-form-label">Link szülő kategória</label>
                <select class="form-control" id="linkable_type" name="linkable_type" onchange="onChangeLinkable(value)">
                    @foreach($extraDatas['linkables'] as $name => $morph)
                        <option value="{{$morph['model']}}" {{ (isset($entity) && $entity->linkable_type == $morph['model']) || (isset($linkable_type) && $linkable_type == $morph['model']) ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="linkable_id" class="col-form-label">Link szülő</label>
                <select class="form-control" id="linkable_id" name="linkable_id" >
                    <option value="0" {{ isset($entity) && $entity->linkable_id == '' ? 'selected' : ''}}>Nincs szülő</option>
                    @foreach($extraDatas['linkables'] as $group)
                        @foreach($group['items'] as $linkable)
                        <option value="{{$linkable->id}}" class="linkable {{$group['css-class']}}" {{isset($entity) && $group['model'] == $entity->linkable_type && $entity->linkable_id == $linkable->id ? 'selected' : ''}}>{{$linkable->name}} </option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            @elseif(isset($entity))
            <input type="hidden" id="linkable_type" name="linkable_type" value="{{$entity->linkable_type}}" >
            <input type="hidden" id="linkable_id" name="linkable_id" value="{{$entity->linkable_id}}" >
            @else 
            <input type="hidden" id="linkable_type" name="linkable_type" value="{{$linkable_type}}" >
            <input type="hidden" id="linkable_id" name="linkable_id" value="{{$linkable_id}}" >
            @endif
            <div class="form-group col-lg-12">
                <label for="linktype_id" class="col-form-label">Linktípus</label>
                <select class="form-control" id="linktype_id" name="linktype_id">
                    <option value="0" selected >Nincs típus</option>
                    @foreach($extraDatas['linktypes'] as $linktype)
                        <option value="{{$linktype->id}}" {{isset($entity) && $entity->linktype_id == $linktype->id ? 'selected' : ''}}>{{$linktype->name}}</option>

                    @endforeach
                    <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="publish_date" class="col-form-label">Láthatóság</label>  
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ isset($entity) && $entity->visible ? 'checked' : '' }} onchange="onChange(this)">
                    <label class="form-check-label" for="visible">
                        <div class="btn btn-success {{ isset($entity) && $entity->visible ? '' : 'd-none' }}" id="visible_true">
                            <i class="fa fa-eye fa-lg"></i>
                        </div>
                        <div class="btn btn-danger {{ isset($entity) && $entity->visible ? 'd-none' : '' }}" id="visible_false">
                            <i class="fa fa-eye-slash fa-lg"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.links.index')}}"  class="btn btn-secondary">Vissza a listához</a>
        <a href="{{$entity->parent_edit_route}}"  class="btn btn-secondary">Vissza a szülő oldalára</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
    <input type="hidden" id="redirect_route" name="redirect_route" value="{{isset($redirectUrl) ? $redirectUrl : ''}}">
</form>
<script>
    const linkableType = document.getElementById("linkable_type");
    let linkableTypeValue = linkableType.value;

    toggleLinkables(linkableType.value);

    function onChangeLinkable(newType)
    {
        const oldType = document.getElementById("linkable_type").value;
        if (linkableTypeValue !== newType) {    
            document.getElementById("linkable_id").selectedIndex = 0;
            linkableTypeValue = document.getElementById("linkable_type").value;
        }

        toggleLinkables(newType);
    }

    function toggleLinkables(type) 
    {
        const className = type.replace('App\\Models\\', '').toLowerCase();
        const linkables = document.querySelectorAll('.linkable');
        const activeLinkables = document.querySelectorAll('.' + className);

        linkables.forEach(linkable => {
            if (Array.from(activeLinkables).includes(linkable)) {
                linkable.classList.remove("d-none");
            } else {
                linkable.classList.add("d-none");
            }
        });
    }
</script>
