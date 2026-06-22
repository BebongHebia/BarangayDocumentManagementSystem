<div class="modal fade" id="UploadCalendarActivityImage">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Upload/Update Image Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="position-relative">
                            <img src="assets/images/galleryIcon.png" id="calActImage" class="img-fluid img-thumbnail" style="max-height: 400px;">
                            <button type="button" id="deleteImageBtn" class="btn btn-danger btn-sm position-absolute" style="top: 10px; right: 10px; display: none;" onclick="deleteCalendarImage()">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <input type="hidden" id="imgCode" name="imgCode">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <form id="uploadImageCalendarForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="imageInput">Select Image</label>
                                <input type="file" class="form-control" name="image" id="imageInput" accept="image/*">
                                <small class="form-text text-muted">
                                    Allowed formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                </small>
                            </div>

                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label>Preview:</label>
                                <img id="previewImage" src="#" alt="Preview" class="img-fluid" style="max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                            </div>

                            <button type="submit" id="submitImageBtn" class="btn btn-dark mt-3">
                                <i class="fas fa-upload"></i> Upload Image
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <div>
                    <button type="button" class="btn btn-danger" onclick="deleteCalendarImage()" id="deleteImageBtnFooter" style="display: none;">
                        <i class="fas fa-trash"></i> Delete Image
                    </button>
                    <button type="button" class="btn btn-dark" onclick="$('#uploadImageCalendarForm').submit();">
                        <i class="fas fa-save"></i> Save Image
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
