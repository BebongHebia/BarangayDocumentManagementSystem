<div class="modal fade" id="UploadAnnouncementImage">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white">
                    <i class="fas fa-upload"></i> Upload Announcement Image/Logo
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Image preview here -->
                        <div id="imagePreviewContainer" style="text-align: center; padding: 20px; border: 2px dashed #ddd; border-radius: 8px; min-height: 200px; display: flex; align-items: center; justify-content: center;">
                            <div id="imagePreview">
                                <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
                                <p style="color: #999; margin-top: 10px;">No image uploaded</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <form id="uploadAnnouncementImageForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="annCode" name="annCode">
                            <input type="hidden" id="announcementId" name="announcementId">

                            <div class="form-group">
                                <label for="fileInput">Choose Image</label>
                                <input type="file" id="fileInput" name="file" class="form-control" accept="image/*" required>
                                <small class="text-muted">Max size: 2MB. Allowed: JPG, PNG, GIF</small>
                            </div>

                            <div id="uploadStatus" class="mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-dark" onclick="uploadAnnouncementImage()">
                    <i class="fas fa-upload"></i> Upload Image
                </button>
            </div>
        </div>
    </div>
</div>
