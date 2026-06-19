<div class="modal fade" id="TakePictureModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Take Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <!-- Camera Preview -->
                        <div style="position: relative; background: #000; border-radius: 5px; overflow: hidden; margin-bottom: 15px;">
                            <video id="video" class="img-fluid" style="max-height: 400px; min-height: 200px; width: 100%; background: #000; transform: scaleX(-1);" autoplay></video>
                            <canvas id="canvas" style="display: none;"></canvas>

                            <!-- Loading overlay -->
                            <div id="cameraLoading" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; display: none;">
                                <i class="fas fa-spinner fa-spin fa-2x"></i>
                                <p>Starting camera...</p>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-3 mb-3">
                            <button id="startCameraBtn" class="btn btn-success btn-lg" onclick="startCamera()">
                                <i class="fas fa-camera"></i> Start Camera
                            </button>
                            <button id="captureBtn" class="btn btn-danger btn-lg" onclick="capturePhoto()" style="display: none;">
                                <i class="fas fa-camera-retro"></i> Capture
                            </button>
                            <button id="retakeBtn" class="btn btn-warning btn-lg" onclick="retakePhoto()" style="display: none;">
                                <i class="fas fa-redo"></i> Retake
                            </button>
                        </div>

                        <!-- Preview of captured image -->
                        <div id="capturedImagePreview" style="display: none;" class="mt-3">
                            <h6>Preview:</h6>
                            <img id="capturedImage" src="#" class="img-fluid" style="max-height: 300px; border: 2px solid #ddd; border-radius: 5px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-dark" id="submitPhotoBtn" onclick="submitCapturedPhoto(event)" style="display: none;">
                    <i class="fas fa-upload"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>
