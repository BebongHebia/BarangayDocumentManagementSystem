<div class="modal fade" id="DeleteTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Deleting Transactions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteTransactionForm">
                    <input type="hidden" name="transactionId" id="deleteTransactionId">
                    <h4 class="text-center">Are you sure you want to delete this transaction?</h4>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteTransaction(event)">
                    <i class="fas fa-trash"></i> Confirm Delete
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
