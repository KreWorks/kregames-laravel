<!-- Add Jam Modal-->
<div class="modal fade" id="userForm" tabindex="-1" aria-labelledby="userFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="userFormTitlelabel">Játék létrehozása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.users.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-lg-12">
                                <label for="name" class="col-form-label">Név</label>
                                <input class="form-control" type="text" value="" id="name" name="name">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="username" class="col-form-label">Felhaszánlónév</label>
                                <input class="form-control" type="text" value="" id="username" name="username">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="email" class="col-form-label">Email</label>
                                <input class="form-control" type="email" value="" id="email" name="email">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="password" class="col-form-label">Jelszó</label>
                                <input class="form-control" type="password" value="" id="password" name="password">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="password_again" class="col-form-label">Jelszó ismét</label>
                                <input class="form-control" type="password" value="" id="password_again" name="password_again">
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
