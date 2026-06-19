<div class="modal fade" id="UploadImageModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Uploading Profile Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="text-center">Upload/Edit Image</h5>
                        <form id="addProfilePicForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="userCode" value="{{ $user->userCode }}">
                            <input type="file" class="btn btn-warning btn-block" name="image">
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-center">Take a Picture</h5>
                        <img src="{{ asset('assets/images/takeApic.png') }}" class="img-fluid">
                        <button class="btn btn-block btn-info" onclick="openTakePicModal()">
                            <i class="fas fa-camera"></i> Take a Piicture with camera
                        </button>
                    </div>
                </div>



            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addProfilePicWithProgress(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
