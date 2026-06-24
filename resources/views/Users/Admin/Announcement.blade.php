@extends('Users.Admin.Sidebar')
@section('sidebar')
@include("Components.Announcement.AddAnnouncementModal")
@include("Components.Announcement.EditAnnouncementModal")
@include("Components.Announcement.DeleteAnnouncementModal")
@include("Components.Announcement.UploadAnnouncementImage")
<style>
    /* Container Design */
    .announcementContainer {
        width: 100%;
        padding: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 20px;
    }

    .announcementContainer:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Image Section */
    .announcementImage {
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-radius: 6px 6px 0 0;
        background: #f5f5f5;
        position: relative;
    }

    .announcementImage img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .announcementImage .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #999;
        font-size: 14px;
        background: #f9f9f9;
        border: 2px dashed #ddd;
        border-radius: 6px 6px 0 0;
    }

    /* Description Section */
    .announcementBody {
        padding: 15px 5px 10px 5px;
        min-height: 70px;
    }

    .announcementBody h4 {
        margin: 0 0 8px 0;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .announcementBody p {
        margin: 0;
        font-size: 14px;
        color: #666;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Buttons Section */
    .announcementActions {
        padding: 10px 5px 0 5px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-announcement {
        flex: 1;
        min-width: 70px;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-announcement:hover {
        transform: scale(1.02);
        opacity: 0.9;
    }

    /* Button Colors */
    .btn-upload {
        background: #4CAF50;
        color: white;
    }

    .btn-upload:hover {
        background: #45a049;
    }

    .btn-edit {
        background: #2196F3;
        color: white;
    }

    .btn-edit:hover {
        background: #1976D2;
    }

    .btn-delete {
        background: #f44336;
        color: white;
    }

    .btn-delete:hover {
        background: #d32f2f;
    }

    /* Icon styling */
    .btn-announcement i {
        font-size: 14px;
    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Announcement</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h5 class="card-title">Announcemnt Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-dark" data-toggle="modal" data-target="#AddAnnouncement">
                                <i class="fas fa-plus"></i> Add Announcement
                            </button>
                        </div>
                    </div>
                    <div class="row mt-2" id="announcementPanel">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('assets/Javascripts/Announcements/announcement.js') }}"></script>
@endsection
