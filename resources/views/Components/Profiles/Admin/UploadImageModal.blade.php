<style scoped>
    /* Upload card wrapper */
    .upload-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        transition: all 0.2s ease;
    }

    .upload-card:hover {
        border-color: #ced4da;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    /* Card header */
    .upload-card-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .upload-card-header i {
        color: #343a40;
        font-size: 1.1rem;
        display: block;
        margin-bottom: 0.35rem;
    }

    .upload-card-header h6 {
        margin: 0;
        font-weight: 600;
        color: #212529;
    }

    /* Styled file drop zone */
    .file-drop-zone {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 1.25rem 1rem;
        border: 2px dashed #ced4da;
        border-radius: 8px;
        background: #ffffff;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .file-drop-zone:hover {
        border-color: #343a40;
        color: #343a40;
        background: #f1f3f5;
    }

    .file-drop-zone i {
        color: #adb5bd;
        transition: color 0.2s ease;
    }

    .file-drop-zone:hover i {
        color: #343a40;
    }

    /* Make sure row gutters look right */
    .modal-body .row.g-3>[class*="col-"] {
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .modal-body .row.g-3>[class*="col-"] {
            margin-bottom: 0;
        }
    }
</style>

<div class="modal fade" id="UploadImageModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden;">

            <!-- Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-image mr-2"></i> Upload Profile Picture
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <div class="row g-3">

                    <!-- Upload Section -->
                    <div class="col-md-6">
                        <div class="upload-card h-100">
                            <div class="upload-card-header">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h6>Upload / Edit Image</h6>
                                <small class="text-muted">Choose a file from your device</small>
                            </div>

                            <form id="addProfilePicForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="userCode" value="{{ $user->userCode }}">

                                <!-- Styled File Input -->
                                <label for="profileImageInput" class="file-drop-zone">
                                    <i class="fas fa-file-image fa-2x mb-2"></i>
                                    <span id="fileNameDisplay">Click to select an image</span>
                                    <input type="file" id="profileImageInput" name="image" accept="image/*"
                                        class="d-none"
                                        onchange="document.getElementById('fileNameDisplay').textContent = this.files[0]?.name || 'Click to select an image';">
                                </label>
                            </form>
                        </div>
                    </div>

                    <!-- Camera Section -->
                    <div class="col-md-6">
                        <div class="upload-card h-100">
                            <div class="upload-card-header">
                                <i class="fas fa-camera"></i>
                                <h6>Take a Picture</h6>
                                <small class="text-muted">Use your camera to snap one</small>
                            </div>

                            <div class="camera-preview text-center mb-3">
                                <img src="{{ asset('assets/images/takeApic.png') }}" class="img-fluid rounded"
                                    style="max-height: 130px; object-fit: contain;">
                            </div>

                            <button class="btn btn-info btn-block" onclick="openTakePicModal()">
                                <i class="fas fa-camera mr-1"></i> Take a Picture with Camera
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer justify-content-between bg-light">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Close
                </button>
                <button type="button" class="btn btn-dark px-4" onclick="addProfilePicWithProgress(event)">
                    <i class="fas fa-check mr-1"></i> Submit
                </button>
            </div>

        </div>
    </div>
</div>