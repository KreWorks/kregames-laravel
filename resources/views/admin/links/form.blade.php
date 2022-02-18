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
            <div class="form-group col-lg-12">
                <label for="linkable_type" class="col-form-label">Link szülő kategória</label>
                <select class="form-control" id="linkable_type" name="linkable_type" onchange="onChangeLinkable(value)">
                    @foreach($extraDatas['morphs'] as $name => $morph)
                        <option value="{{$morph}}" {{isset($entity) && $entity->linkable_type == $morph ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="linkable_id" class="col-form-label">Link szülő</label>
                <select class="form-control" id="linkable_id" name="linkable_id" >
                    <option value="0" {{ isset($entity) && $entity->linktype_id == '' ? 'selected' : ''}}>Nincs szülő</option>
                    @foreach($extraDatas['linkables'] as $group)
                        @foreach($group['items'] as $linkable)
                        <option value="{{$linkable->id}}" {{isset($entity) && $entity->linkable_id == $linkable->id && $entity->linkable_type == $group['model'] ? 'selected' : ''}} class="linkable {{$group['css-class']}}">{{$linkable->name}}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="linktype_id" class="col-form-label">Linktípus</label>
                <select class="form-control" id="linktype_id" name="linktype_id">
                    <option value="0" {{ isset($entity) && $entity->linktype_id == '' ? 'selected' : ''}}>Nincs típus</option>
                    @foreach($extraDatas['linktypes'] as $linktype)
                        <option value="{{$linktype->id}}" {{isset($entity) && $entity->linktype_id == $linktype->id ? 'selected' : ''}}>{{$linktype->name}}</option>

                    @endforeach
                    <select>
            </div>
        </div>
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.links.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
    <input type="hidden" id="redirect_route" name="redirect_route" value="{{isset($redirectRoute) ? $redirectRoute : ''}}">
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
