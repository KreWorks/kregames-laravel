<div id="deleteModal" class="modal fade delete-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Törlés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ClÍose"></button>
            </div>
            <div class="modal-body">
                <p>Biztos, hogy szeretnéd törölni a(z) <b><span id="deleteString">xx</span></b> elemet?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Mégsem</button>
                <form method="POST" id="deleteForm" action="">
                    @method('DELETE') 
                    @csrf
                    <input type="hidden" id="redirect_route_on_delete" name="redirect_route_on_delete" value="" >
                    <button class="btn btn-danger">Törlés</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/modal.js') }}"></script>
