<?php
include '../../connectMySql.php';
include '../../loginverification.php';

// Handle bulk actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bulk_action']) && isset($_POST['selected_items'])) {
        $action = $_POST['bulk_action'];
        $selected_ids = $_POST['selected_items'];
        
        if ($action === 'delete_forever') {
            foreach ($selected_ids as $id) {
                $stmt = $conn->prepare("DELETE FROM spam WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
            }
            $success_msg = count($selected_ids) . " spam report(s) deleted permanently.";
        } elseif ($action === 'not_spam') {
            foreach ($selected_ids as $id) {
                // Move from spam to incident table
                $stmt = $conn->prepare("INSERT INTO incident SELECT * FROM spam WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                
                // Delete from spam
                $stmt = $conn->prepare("DELETE FROM spam WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
            }
            $success_msg = count($selected_ids) . " report(s) moved to Incidents.";
        }
    }
}

if (logged_in()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>iSumbong - Incident Management</title>
        <link rel="icon" type="image/x-icon" href="../../img/logo1.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="../../img/logo1.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../img/logo1.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../../img/logo1.png">

        <!-- Custom fonts for this template-->
        <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <script src="../../js/html2canvas.min.js"></script>
        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../../js/sweetalert2.min.css" rel="stylesheet">
        <script src="../../js/sweetalert2.min.js"></script>

        <style>
            /* Gmail-style Spam Inbox */
            body {
                font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
                background-color: #f5f5f5;
            }

            .gmail-container {
                background: white;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12);
                overflow: hidden;
            }

            /* Toolbar */
            .gmail-toolbar {
                display: flex;
                align-items: center;
                padding: 12px 16px;
                border-bottom: 1px solid #e0e0e0;
                background: #fff;
                gap: 12px;
            }

            .gmail-toolbar .checkbox-all {
                width: 18px;
                height: 18px;
                cursor: pointer;
            }

            .gmail-toolbar select {
                border: 1px solid #dadce0;
                border-radius: 4px;
                padding: 6px 32px 6px 12px;
                font-size: 14px;
                color: #5f6368;
                background: white;
                cursor: pointer;
                outline: none;
            }

            .gmail-toolbar select:hover {
                background: #f8f9fa;
                border-color: #c6c6c6;
            }

            .gmail-toolbar .btn-action {
                border: none;
                background: white;
                color: #5f6368;
                padding: 8px 16px;
                border-radius: 4px;
                font-size: 14px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: all 0.2s;
            }

            .gmail-toolbar .btn-action:hover {
                background: #f8f9fa;
            }

            .gmail-toolbar .btn-action:disabled {
                opacity: 0.4;
                cursor: not-allowed;
            }

            .search-box {
                flex: 1;
                max-width: 500px;
            }

            .search-box input {
                width: 100%;
                padding: 10px 16px;
                border: 1px solid #dadce0;
                border-radius: 24px;
                font-size: 14px;
                background: #f1f3f4;
            }

            .search-box input:focus {
                background: white;
                outline: none;
                border-color: #1a73e8;
                box-shadow: 0 1px 6px rgba(26, 115, 232, 0.3);
            }

            /* Email List */
            .gmail-list {
                background: white;
            }

            .gmail-item {
                display: flex;
                align-items: center;
                padding: 12px 16px;
                border-bottom: 1px solid #f0f0f0;
                cursor: pointer;
                transition: all 0.1s;
                gap: 16px;
            }

            .gmail-item:hover {
                box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
                z-index: 1;
            }

            .gmail-item.unread {
                background: #f8f9fa;
                font-weight: 600;
            }

            .gmail-item input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
            }

            .gmail-star {
                color: #dadce0;
                font-size: 18px;
                cursor: pointer;
                transition: color 0.2s;
            }

            .gmail-star:hover {
                color: #f4b400;
            }

            .gmail-star.starred {
                color: #f4b400;
            }

            .gmail-sender {
                min-width: 200px;
                font-size: 14px;
                color: #202124;
            }

            .gmail-subject {
                flex: 1;
                font-size: 14px;
                color: #202124;
                display: flex;
                gap: 8px;
            }

            .gmail-subject .subject-text {
                font-weight: 500;
            }

            .gmail-subject .preview-text {
                color: #5f6368;
                font-weight: 400;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .gmail-attachment {
                color: #5f6368;
                font-size: 14px;
            }

            .gmail-date {
                min-width: 100px;
                text-align: right;
                font-size: 12px;
                color: #5f6368;
            }

            .gmail-status {
                display: inline-block;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 11px;
                font-weight: 500;
                text-transform: uppercase;
            }

            .status-pending {
                background: #fef7e0;
                color: #f9ab00;
            }

            .status-investigating {
                background: #e8f0fe;
                color: #1967d2;
            }

            .status-resolved {
                background: #e6f4ea;
                color: #137333;
            }

            /* Warning Banner */
            .spam-warning {
                background: #fff3cd;
                border-left: 4px solid #ffc107;
                padding: 12px 16px;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .spam-warning i {
                color: #f57c00;
                font-size: 20px;
            }

            .spam-warning-text {
                flex: 1;
                font-size: 14px;
                color: #5f6368;
            }

            /* Selection info */
            .selection-info {
                padding: 8px 16px;
                background: #e8f0fe;
                border-bottom: 1px solid #d2e3fc;
                font-size: 13px;
                color: #1967d2;
                display: none;
            }

            .selection-info.active {
                display: block;
            }

            /* Empty state */
            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #5f6368;
            }

            .empty-state i {
                font-size: 48px;
                color: #dadce0;
                margin-bottom: 16px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .gmail-sender {
                    min-width: 120px;
                }
                
                .gmail-date {
                    min-width: 60px;
                    font-size: 11px;
                }
                
                .gmail-subject .preview-text {
                    display: none;
                }
            }
        </style>

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include '../sidebar.php'; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <?php include '../nav.php'; ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <?php if (isset($success_msg)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?= $success_msg ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php endif; ?>

                        <!-- Gmail-style Spam Inbox -->
                        <div class="gmail-container">
                            
                            <!-- Spam Warning Banner -->
                            <div class="spam-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div class="spam-warning-text">
                                    <strong>These messages are in Spam.</strong> Messages that have been in Spam for more than 30 days will be automatically deleted.
                                </div>
                            </div>

                            <!-- Selection Info -->
                            <div class="selection-info" id="selectionInfo">
                                <span id="selectedCount">0</span> selected
                            </div>

                            <!-- Toolbar -->
                            <form method="POST" id="bulkActionForm">
                                <div class="gmail-toolbar">
                                    <input type="checkbox" class="checkbox-all" id="selectAll" title="Select all">
                                    
                                    <select name="bulk_action" id="bulkAction" disabled>
                                        <option value="">Actions</option>
                                        <option value="delete_forever">Delete forever</option>
                                        <option value="not_spam">Not spam</option>
                                    </select>

                                    <button type="button" class="btn-action" id="refreshBtn" title="Refresh">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>

                                    <div class="search-box">
                                        <input type="text" id="searchInput" placeholder="Search spam reports...">
                                    </div>
                                </div>

                                <!-- Email List -->
                                <div class="gmail-list" id="spamList">
                                    <?php
                                    $query = "SELECT s.*, 
                                              (SELECT COUNT(*) FROM attachment WHERE incident_id = s.id) as attachment_count
                                              FROM spam s 
                                              ORDER BY s.date DESC";
                                    $result = $conn->query($query);
                                    
                                    if ($result->num_rows == 0) {
                                        echo '<div class="empty-state">
                                                <i class="fas fa-inbox"></i>
                                                <h5>No spam reports</h5>
                                                <p>Messages marked as spam will appear here</p>
                                              </div>';
                                    } else {
                                        while ($row = $result->fetch_assoc()) {
                                            $status_class = '';
                                            switch ($row['status']) {
                                                case 'PENDING':
                                                    $status_class = 'status-pending';
                                                    break;
                                                case 'INVESTIGATING':
                                                    $status_class = 'status-investigating';
                                                    break;
                                                case 'RESOLVED':
                                                    $status_class = 'status-resolved';
                                                    break;
                                            }
                                            
                                            $description_preview = substr(strip_tags($row['description'] ?? ''), 0, 100);
                                            $date_formatted = date('M j', strtotime($row['date']));
                                            $threat_category = $row['threat_category'] ?? $row['title'] ?? 'Spam Report';
                                            
                                            echo '<div class="gmail-item" data-id="'.$row['id'].'" onclick="viewReport('.$row['id'].')">
                                                    <input type="checkbox" name="selected_items[]" value="'.$row['id'].'" class="item-checkbox" onclick="event.stopPropagation()">
                                                    <i class="far fa-star gmail-star" onclick="event.stopPropagation(); toggleStar(this)"></i>
                                                    <div class="gmail-sender">'.htmlspecialchars($row['title'] ?? 'No Title').'</div>
                                                    <div class="gmail-subject">
                                                        <span class="subject-text">'.htmlspecialchars($threat_category).'</span>
                                                        <span class="preview-text">- '.htmlspecialchars($description_preview).'...</span>
                                                    </div>';
                                            
                                            if ($row['attachment_count'] > 0) {
                                                echo '<div class="gmail-attachment" title="'.$row['attachment_count'].' attachment(s)">
                                                        <i class="fas fa-paperclip"></i>
                                                      </div>';
                                            }
                                            
                                            echo '<span class="gmail-status '.$status_class.'">'.htmlspecialchars($row['status'] ?? 'PENDING').'</span>
                                                    <div class="gmail-date">'.$date_formatted.'</div>
                                                  </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- End of Page Content -->
                </div>
                <!-- End of Content Wrapper -->
                <?php include '../footer.php'; ?>

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../../js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="../../vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../../js/demo/chart-area-demo.js"></script>
            <script src="../../js/demo/chart-pie-demo.js"></script>
            <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <script>
                // Gmail-style functionality
                const selectAllCheckbox = document.getElementById('selectAll');
                const itemCheckboxes = document.querySelectorAll('.item-checkbox');
                const bulkAction = document.getElementById('bulkAction');
                const selectionInfo = document.getElementById('selectionInfo');
                const selectedCount = document.getElementById('selectedCount');
                const searchInput = document.getElementById('searchInput');
                const spamList = document.getElementById('spamList');
                const refreshBtn = document.getElementById('refreshBtn');

                // Select All functionality
                selectAllCheckbox.addEventListener('change', function() {
                    itemCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectionUI();
                });

                // Individual checkbox selection
                itemCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectionUI);
                });

                function updateSelectionUI() {
                    const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
                    selectedCount.textContent = checkedCount;
                    
                    if (checkedCount > 0) {
                        selectionInfo.classList.add('active');
                        bulkAction.disabled = false;
                    } else {
                        selectionInfo.classList.remove('active');
                        bulkAction.disabled = true;
                    }

                    selectAllCheckbox.checked = checkedCount === itemCheckboxes.length && checkedCount > 0;
                }

                // Bulk action handler
                bulkAction.addEventListener('change', function() {
                    if (this.value) {
                        const checkedCount = document.querySelectorAll('.item-checkbox:checked').length;
                        
                        if (this.value === 'delete_forever') {
                            Swal.fire({
                                title: 'Delete Forever?',
                                text: `Are you sure you want to permanently delete ${checkedCount} spam report(s)? This cannot be undone.`,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete forever',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('bulkActionForm').submit();
                                } else {
                                    this.value = '';
                                }
                            });
                        } else if (this.value === 'not_spam') {
                            Swal.fire({
                                title: 'Mark as Not Spam?',
                                text: `Move ${checkedCount} report(s) back to Incidents?`,
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, not spam',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('bulkActionForm').submit();
                                } else {
                                    this.value = '';
                                }
                            });
                        }
                    }
                });

                // Search functionality
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const items = document.querySelectorAll('.gmail-item');
                    
                    items.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });

                // View report
                function viewReport(id) {
                    window.location.href = 'view.php?id=' + id;
                }

                // Toggle star
                function toggleStar(element) {
                    element.classList.toggle('far');
                    element.classList.toggle('fas');
                    element.classList.toggle('starred');
                }

                // Refresh button
                refreshBtn.addEventListener('click', function() {
                    this.querySelector('i').classList.add('fa-spin');
                    location.reload();
                });
            </script>
    </body>

    </html>
<?php
} else {
    header('location:../../index.php');
} ?>