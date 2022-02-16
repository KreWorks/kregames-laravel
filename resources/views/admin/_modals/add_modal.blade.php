<div class="modal fade" id="{{$name}}Form" tabindex="-1" aria-labelledby="{{$name}}FormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="{{$name}}FormTitlelabel">{{$displayName}} létrehozása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @include('admin.'.$route.'.form')
            </div>
        </div>
    </div>
</div>