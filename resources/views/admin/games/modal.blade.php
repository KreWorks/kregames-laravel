<!-- Add Jam Modal-->
<div class="modal fade" id="gameForm" tabindex="-1" aria-labelledby="gameFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="gameFormTitlelabel">Játék létrehozása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.games.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-lg-12">
                                <label for="name" class="col-form-label">Név</label>
                                <input class="form-control" type="text" value="" id="name" name="name" onkeyup="document.getElementById('slug').value = createSlug(value)">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="slug" class="col-form-label">Slug</label>
                                <input class="form-control" type="text" value="" id="slug" name="slug">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="publish_date" class="col-form-label">Megjelenés dátuma</label>
                                <input class="form-control" type="datetime-local" value="{{ time() }}" id="publish_date" name="publish_date">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="jam_id" class="col-form-label">Jam</label>
                                <select class="form-control" id="jam_id" name="jam_id">
                                    <option value="0" selected>Nincs jam</option>
                                    @foreach($extraDatas['jams'] as $jam)
                                        <option value="{{$jam->id}}">{{$jam->name}}</option>

                                    @endforeach
                                    <select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-lg-12">
                                <label for="icon" class="form-label">Logó</label>
                                <input class="form-control" type="file" id="icon" name="icon">
                            </div>
                            <div class="col-lg-12">
                                <img class="col-lg-3" src="/">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
                        <button type="submit" class="btn btn-primary">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
