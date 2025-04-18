<?php include 'header.php'; ?>
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient' || !$_SESSION['active']) {
        $error_message = "You must be a verified patient to submit a case.";
    } else {
        $patient_id = $_SESSION['user_id'];
        $title = $conn->real_escape_string($_POST['title']);
        $description = $conn->real_escape_string($_POST['description']);
        $category = $_POST['caseType'];
        $tags = $conn->real_escape_string($_POST['tags']);
        $target_amount = $_POST['target_amount'];

        $stmt = $conn->prepare("INSERT INTO cases (patient_id, title, description, category, tags, target_amount) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssd", $patient_id, $title, $description, $category, $tags, $target_amount);
        $stmt->execute();
        $case_id = $stmt->insert_id;
        $stmt->close();

        $image_dir = "imgs/";
        foreach ($_FILES["fileAttachment"]["tmp_name"] as $index => $tmp_name) {
            if ($_FILES["fileAttachment"]["error"][$index] === 0) {
                $filename = time() . "_" . basename($_FILES["fileAttachment"]["name"][$index]);
                $target_path = $image_dir . $filename;
                move_uploaded_file($tmp_name, $target_path);

                $stmt = $conn->prepare("INSERT INTO case_images (case_id, image_url) VALUES (?, ?)");
                $stmt->bind_param("is", $case_id, $target_path);
                $stmt->execute();
                $stmt->close();
            }
        }

        echo "<script>alert('Case submitted successfully.'); window.location.href='cases.php';</script>";
    }
}
?>
     <!--* ======================================================== start the form ======================================== -->
     <div class="container mb-5">
        <div class="form-container m-5 p-5" id="up">
            <h2 class="form-title"><i class="fa-solid fa-file-lines"></i> Medical/Dental Case Submission</h2>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                  <?= $error_message ?>
                </div>
            <?php endif; ?>
            <form id="caseForm" enctype="multipart/form-data" method="POST">
                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h5 class="mb-3 border-bottom pb-2">Personal Information</h5>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="form-label required-field">Case Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="age" class="form-label required-field">Age</label>
                            <input type="text" class="form-control" id="age" name="age" min="0" max="120" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label required-field">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="idNumber" class="form-label required-field">ID Number</label>
                            <input type="text" class="form-control" id="idNumber" name="idNumber" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="target_amount" class="form-label required-field">Target Donation Amount</label>
                            <input type="number" class="form-control" id="target_amount" name="target_amount" min="1" required>
                        </div>

                    </div>
                </div>
                
                <!-- Case Information Section -->
                <div class="mb-4">
                    <h5 class="mb-3 border-bottom pb-2">Case Information</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-field">Case Type</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="caseType" id="dental" value="dental" required>
                                <label class="form-check-label" for="dental">Dental اسنان</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="caseType" id="medical" value="medical">
                                <label class="form-check-label" for="medical">Medical بشري</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tags" class="form-label">Tags (comma-separated)</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g. dental, cavity, xray">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label required-field">Case Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="fileAttachment" class="form-label">File Attachment</label>
                            <input class="form-control" type="file" id="fileAttachment" name="fileAttachment[]" multiple>
                            <div class="form-text">You can upload X-rays, reports, or other relevant documents (PDF, JPG, PNG)</div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">
                        <i class="fa-solid fa-paper-plane me-2"></i> Submit Case
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!--* ======================================================== start footer ======================================== -->
    <?php include 'footer.php'; ?>