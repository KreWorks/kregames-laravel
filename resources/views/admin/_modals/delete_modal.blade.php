<div id="deleteModal" class="modal fade delete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Törlés</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Biztos, hogy szeretnéd törölni a(z) <span id="deleteString">xx</span> elemet?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Mégsem</button>
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
