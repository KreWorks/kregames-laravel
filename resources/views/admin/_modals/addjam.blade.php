<!-- Add Jam Modal-->
<div class="modal fade" id="addJam" tabindex="-1" aria-labelledby="addJamLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Jam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jamtitle" class="form-label">Név</label>
                        <input type="text" name="jamtitle" id="jamtitle" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamslug" class="form-label">Slug</label>
                        <input type="text" name="jamslug" id="jamslug" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jammembers" class="form-label">Indulók</label>
                        <input type="number" name="jammembers" id="jammembers" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamtheme" class="form-label">Téma</label>
                        <input type="text" name="jamtheme" id="jamtheme" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamstart" class="form-label">Kezdés</label>
                        <input type="date" name="jamstart" id="jamstart" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamend" class="form-label">Befejezés</label>
                        <input type="date" name="jamend" id="jamend" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jamicon" class="form-label">Ikon</label>
                        <input type="file" name="jamicon" id="jamicon" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
