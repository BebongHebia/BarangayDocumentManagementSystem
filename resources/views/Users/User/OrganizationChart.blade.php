@extends('Users.User.Sidebar')
@section('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Organizational Charts</h1>
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
            <!-- Organizational Chart -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Barangay Officials Organizational Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-primary" onclick="refreshChart()">
                                    <i class="fas fa-sync"></i> Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="orgChartContainer">
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <p class="mt-2">Loading organizational chart...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .org-chart {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        min-height: 400px;
    }

    .org-node {
        transition: all 0.3s ease;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        height: 100%;
    }

    .org-node:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .head-node {
        border: 2px solid #007bff;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        max-width: 300px;
        margin: 0 auto;
    }

    .subordinate-node {
        border: 1px solid #dee2e6;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .subordinate-node:hover {
        border-color: #17a2b8;
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.2);
    }

    .node-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .org-level {
        position: relative;
    }

    .org-subordinates .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .org-subordinates .card-header {
        border-bottom: none;
        border-radius: 8px 8px 0 0 !important;
    }

    .org-subordinates .card-body {
        background: #f8f9fa;
        border-radius: 0 0 8px 8px;
    }

    .avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Connector styles */
    .connector-line {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px 0;
    }

    .connector-line .vertical-line {
        width: 2px;
        height: 30px;
        background: #dee2e6;
    }

    .connector-line .horizontal-line {
        width: 80%;
        height: 2px;
        background: #dee2e6;
        position: relative;
    }

    .connector-line .horizontal-line .connector-icon {
        position: absolute;
        top: -8px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        padding: 0 10px;
        color: #6c757d;
    }

    /* Status badges */
    .badge-status {
        font-size: 10px;
        padding: 3px 8px;
    }

    .badge-status.active {
        background-color: #28a745;
        color: white;
    }

    .badge-status.inactive {
        background-color: #dc3545;
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {

        .org-subordinates .col-md-6,
        .org-subordinates .col-md-3 {
            margin-bottom: 20px;
        }

        .head-node {
            max-width: 100%;
        }
    }

    /* Animation for nodes */
    .org-node {
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading animation */
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Function to render the organizational chart
    function renderOrgChart(data) {
        const container = document.getElementById('orgChartContainer');

        // Filter active staff officials
        const activeStaff = data.filter(staff => staff.status === 'Active');

        // Find the Punong Barangay (head)
        const head = activeStaff.find(staff => staff.position === 'Punong Barangay');

        // Get all Kagawads
        const kagawads = activeStaff.filter(staff => staff.position === 'Kagawad');

        // Get Secretary
        const secretary = activeStaff.find(staff => staff.position === 'Secretary');

        // Get Treasurer
        const treasurer = activeStaff.find(staff => staff.position === 'Treasurer');

        if (!head) {
            container.innerHTML = `
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle"></i>
                No active Punong Barangay found. Please add a Punong Barangay to display the organizational chart.
            </div>
        `;
            return;
        }

        let html = '<div class="org-chart">';

        // Head of Organization
        html += `
        <div class="org-level text-center mb-5">
            <div class="org-node head-node">
                <div class="node-content">
                    ${getProfileImage(head, 80, '#007bff')}
                    <h5 class="mb-1">${escapeHtml(head.completeName)}</h5>
                    <span class="badge badge-primary">${escapeHtml(head.position)}</span>
                    <div><small class="text-muted">Status: <span class="badge badge-status ${head.status.toLowerCase()}">${head.status}</span></small></div>
                    ${head.sex ? `<div><small class="text-muted">Sex: ${head.sex}</small></div>` : ''}
                </div>
            </div>
        </div>
    `;

        // Connector lines
        html += `
        <div class="connector-line">
            <div class="vertical-line"></div>
            <div class="horizontal-line">
                <span class="connector-icon">
                    <i class="fas fa-sitemap"></i>
                </span>
            </div>
            <div class="vertical-line"></div>
        </div>
    `;

        // Subordinates
        html += `<div class="org-subordinates"><div class="row justify-content-center">`;

        // Kagawads Column
        if (kagawads.length > 0) {
            html += `
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-users"></i> Barangay Kagawads
                            <span class="badge badge-light float-right">${kagawads.length}</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                `;

            kagawads.forEach(kagawad => {
                html += `
                <div class="col-md-6 mb-3">
                    <div class="org-node subordinate-node text-center p-3 border rounded">
                        <div class="node-content" onclick="showStaffDetails('${kagawad.id}')">
                            ${getProfileImage(kagawad, 60, '#17a2b8')}
                            <h6 class="mb-1">${escapeHtml(kagawad.completeName)}</h6>
                            <span class="badge badge-info">${escapeHtml(kagawad.position)}</span>
                            <div><small class="text-muted">Status: <span class="badge badge-status ${kagawad.status.toLowerCase()}">${kagawad.status}</span></small></div>
                        </div>
                    </div>
                </div>
            `;
            });

            html += `
                        </div>
                    </div>
                </div>
            </div>
        `;
        }

        // Support Staff Column (Secretary and Treasurer)
        if (secretary || treasurer) {
            html += `
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-tie"></i> Support Staff
                        </h5>
                    </div>
                    <div class="card-body">
        `;

            if (secretary) {
                html += `
                <div class="org-node subordinate-node text-center p-3 border rounded mb-3">
                    <div class="node-content" onclick="showStaffDetails('${secretary.id}')">
                        ${getProfileImage(secretary, 60, '#28a745')}
                        <h6 class="mb-1">${escapeHtml(secretary.completeName)}</h6>
                        <span class="badge badge-success">Secretary</span>
                        <div><small class="text-muted">Status: <span class="badge badge-status ${secretary.status.toLowerCase()}">${secretary.status}</span></small></div>
                    </div>
                </div>
            `;
            }

            if (treasurer) {
                html += `
                <div class="org-node subordinate-node text-center p-3 border rounded">
                    <div class="node-content" onclick="showStaffDetails('${treasurer.id}')">
                        ${getProfileImage(treasurer, 60, '#28a745')}
                        <h6 class="mb-1">${escapeHtml(treasurer.completeName)}</h6>
                        <span class="badge badge-success">Treasurer</span>
                        <div><small class="text-muted">Status: <span class="badge badge-status ${treasurer.status.toLowerCase()}">${treasurer.status}</span></small></div>
                    </div>
                </div>
            `;
            }

            html += `
                    </div>
                </div>
            </div>
        `;
        }

        html += `</div></div>`; // Close row and org-subordinates
        html += `</div>`; // Close org-chart

        container.innerHTML = html;
    }

    // Helper function to get profile image HTML
    function getProfileImage(staff, size, defaultColor) {
        if (staff.staff_image && staff.staff_image.path) {
            const imagePath = `/storage/${staff.staff_image.path}`;
            return `<img src="${imagePath}"
                     alt="${escapeHtml(staff.completeName)}"
                     class="rounded-circle mb-2"
                     style="width: ${size}px; height: ${size}px; object-fit: cover; border: 2px solid ${defaultColor};"
                     onerror="this.style.display='none'; this.parentElement.querySelector('.avatar-placeholder').style.display='flex';">`;
        } else {
            const initials = staff.completeName ? staff.completeName.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2) : '?';
            return `<div class="avatar-placeholder mb-2"
                     style="width: ${size}px; height: ${size}px; border-radius: 50%; background: ${defaultColor};
                            display: flex; align-items: center; justify-content: center; margin: 0 auto; color: white; font-size: ${size/2.5}px;">
                    ${initials}
                </div>`;
        }
    }

    // Helper function to escape HTML
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Function to show staff details (you can implement this as needed)
    function showStaffDetails(staffId) {
        // You can implement a modal or redirect to staff details page
        alert(`Viewing details for staff ID: ${staffId}`);
        // Or redirect: window.location.href = `/admin/staff/${staffId}`;
    }

    // Function to fetch data and render chart
    function loadOrgChart() {
        const container = document.getElementById('orgChartContainer');
        container.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2">Loading organizational chart...</p>
        </div>
    `;

        fetch('/get-staff-officials')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                renderOrgChart(data);
            })
            .catch(error => {
                console.error('Error loading organizational chart:', error);
                container.innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-circle"></i>
                    Error loading organizational chart. Please try again later.
                    <br><small class="text-muted">${error.message}</small>
                </div>
            `;
            });
    }

    // Refresh chart function (for the refresh button)
    function refreshChart() {
        loadOrgChart();
    }

    // Load chart when page is ready
    document.addEventListener('DOMContentLoaded', function() {
        loadOrgChart();
    });

    // Auto-refresh every 60 seconds (optional)
    // setInterval(loadOrgChart, 60000);

</script>

@endsection
