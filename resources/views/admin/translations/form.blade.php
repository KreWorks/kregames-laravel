@if (isset($entity))
<form method="POST" action="{{ route('admin.translations.update', $entity->id) }}" name="language-form" id="language-form">
    @method('PUT')
@else 
<form method="POST" action="{{ route('admin.translations.store')}}" name="language-form" id="language-form">
@endif
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">            
            <div class="form-group col-lg-12">
                <label for="language_id" class="col-form-label">Nyelv</label>
                <select class="form-control" id="language_id" name="language_id">
                    <option value="0" {{ isset($entity) && $entity->language_id == '' ? 'selected' : ''}}>Nincs nyelv</option>
                    @foreach($extraDatas['languages'] as $language)
                        <option value="{{$language->id}}" {{isset($entity) && $entity->language_id == $language->id ? 'selected' : ''}}>{{$language->name}}</option>

                    @endforeach
                <select>
            </div>
            @if (isset($entity) || (!isset($translatable_id) && !isset($translatable_type)))
            <div class="form-group col-lg-12">
                <label for="translatable_type" class="col-form-label">Link szülő kategória</label>
                <select class="form-control" id="translatable_type" name="translatable_type" onchange="onChangeTranslatable(value)">
                    @foreach($extraDatas['translatables'] as $name => $morph)
                        <option value="{{$morph['model']}}" {{ (isset($entity) && $entity->translatable_type == $morph['model']) || (isset($translatable_type) && $translatable_type == $morph['model']) ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label for="translatable_id" class="col-form-label">Link szülő</label>
                <select class="form-control" id="translatable_id" name="translatable_id" >
                    <option value="0" {{ isset($entity) && $entity->translatable_id == '' ? 'selected' : ''}}>Nincs szülő</option>
                    @foreach($extraDatas['translatables'] as $group)
                        @if ($group['model'] == 'Page')
                            <option value="{{$group['model']}}" class="translatable {{$group['css-class']}}" {{isset($entity) && $group['model'] == $entity->translatable_type && $entity->translatable_id == 0 ? 'selected' : ''}}>{{$group['model']}} </option>
                        @else
                            @foreach($group['items'] as $translatable)
                            <option value="{{$translatable->id}}" class="translatable {{$group['css-class']}}" {{isset($entity) && $group['model'] == $entity->translatable_type && $entity->translatable_id == $translatable->id ? 'selected' : ''}}>{{$translatable->name}} </option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
            @elseif(isset($entity))
            <input type="hidden" id="translatable_type" name="translatable_type" value="{{$entity->translatable_type}}" >
            <input type="hidden" id="translatable_id" name="translatable_id" value="{{$entity->translatable_id}}" >
            @else 
            <input type="hidden" id="translatable_type" name="translatable_type" value="{{$translatable_type}}" >
            <input type="hidden" id="translatable_id" name="translatable_id" value="{{$translatable_id}}" >
            @endif
            <div class="form-group col-lg-12">
                <label for="contenttype_id" class="col-form-label">Szülő</label>
                <select class="form-control" id="contenttype_id" name="contenttype_id">
                    <option value="0" {{ isset($entity) && $entity->language_id == '' ? 'selected' : ''}}>Nincs nyelv</option>
                    @foreach($extraDatas['contenttypes'] as $contenttype)
                        <option value="{{$contenttype->id}}" class="translatable {{str_replace('app\\models\\','',strtolower($contenttype->model))}}" {{isset($entity) && $entity->contenttype_id == $contenttype->id ? 'selected' : ''}}>{{$contenttype->name}}</option>
                    @endforeach
                <select>
            </div>
            <div class="form-group col-lg-12">
                <label for="content" class="col-form-label">Tartalom</label>
                <textarea class="form-control" id="content" name="content" cols="3"></textarea>
            </div>
        </div>                 
    </div>
    @if (isset($entity))
    <div class="modal-footer mt-3">
        <a href="{{route('admin.translations.index')}}"  class="btn btn-secondary">Vissza</a>
    @else
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
    @endif
        <button type="submit" class="btn btn-primary" >Mentés</button>
    </div>
</form>
<script>
    const linkableType = document.getElementById("translatable_type");
    let linkableTypeValue = linkableType.value;

    toggleTranslatables(linkableType.value);

    function onChangeTranslatable(newType)
    {
        const oldType = document.getElementById("translatable_type").value;
        if (linkableTypeValue !== newType) {    
            document.getElementById("translatable_id").selectedIndex = 0;
            linkableTypeValue = document.getElementById("translatable_type").value;
        }

        toggleTranslatables(newType);
    }

    function toggleTranslatables(type) 
    {
        const className = type.replace('App\\Models\\', '').toLowerCase();
        const translateables = document.querySelectorAll('.translatable');
        const activeTranslateables = document.querySelectorAll('.' + className);

        translateables.forEach(translatable => {
            if (Array.from(activeTranslateables).includes(translatable)) {
                translatable.classList.remove("d-none");
            } else {
                translatable.classList.add("d-none");
            }
        });
    }
</script>