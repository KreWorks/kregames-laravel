<div id="commandModal" class="modal fade delete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Command futtatása</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Biztos, hogy szeretnéd futtatni a(z) <span id="commandName">xx</span> commadot?</p>
                <p id="warningMsg"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">Mégsem</button>
                <form method="POST" id="commandForm" action="">
                    @method('DELETE') 
                    @csrf
                    <button class="btn btn-success">Futtatás</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/modal.js') }}"></script>
