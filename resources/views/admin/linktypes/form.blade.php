<form method="POST" action="{{ route('admin.linktypes.create') }}" enctype="multipart/form-data" name="linktype-form" id="linktype-form">
    @csrf <!-- {{ csrf_field() }} -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group col-lg-12">
                <label for="name" class="col-form-label">Név</label>
                <input class="form-control" type="text" value="" id="name" name="name" >
            </div>
            <div class="form-group col-lg-12">
                <label for="hover_text" class="col-form-label">Hover szöveg</label>
                <input class="form-control" type="text" value="" id="hover_text" name="hover_text">
            </div>
            <div class="form-group col-lg-12">
                <label for="fontawesome" class="col-form-label">Font Awesome</label>
                <input class="form-control" type="text" value="" id="fontawesome" name="fontawesome">
            </div>
            <div class="form-group col-lg-12">
                <label for="color" class="col-form-label">Szín</label>
                <input class="form-control" type="color" value="" id="color" name="color" style="height:50px;width:100px">
            </div>

            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss>Mentés</button>
            </div>
        </div>                 
    </div>
</form>
