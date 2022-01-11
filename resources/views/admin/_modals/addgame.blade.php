<!-- Add Game Modal-->
<div class="modal fade" id="addGame" tabindex="-1" aria-labelledby="addGameLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameLabel">Add Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name">Name: </label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name">Slug: </label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="publishdate">Megjelenés dátuma </label>
                                <input type="date" name="publishdate" id="publishdate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="gamejam">Megjelenés dátuma </label>
                                <select name="gamejam" id="gamejam" class="form-select">
                                    <option value="Nincs Jam">Nincs Jam</option>
                                    <option value="1">Brackey's Game Jam #2</option>
                                    <option value="2">Pizza Jam</option>
                                    <option value="3">Ludum Dare 44</option>
                                    <option value="4">Brackey's Game Jam 2020.1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="gameicon" class="form-label">Ikon</label>
                                <input type="file" name="gameicon" id="gameicon" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
