<?php include 'header.php'; ?>
<?php include 'db.php'; ?>
<?php
$filterCategory = null;
if (isset($_GET['category'])) {
    $category = strtolower($_GET['category']);
    if (in_array($category, ['medical', 'dental'])) {
        $filterCategory = $category;
    }
}

$filterTags = null;
if (isset($_GET['tags']) && !empty($_GET['tags'])) {
    $filterTags = strtolower($_GET['tags']);
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * 6;

$sql = "SELECT c.id, c.title, c.description, c.category, c.tags, c.target_amount, i.image_url 
        FROM cases c 
        JOIN case_images i ON c.id = i.case_id";

if ($filterCategory) {
    $sql .= " WHERE c.category = '" . $conn->real_escape_string($filterCategory) . "'";
}

if ($filterTags) {
    $sql .= " AND c.tags LIKE '%" . $conn->real_escape_string($filterTags) . "%'";
}

$sql .= " LIMIT 6 OFFSET $offset";

$result = $conn->query($sql);

$countResult = $conn->query("SELECT COUNT(*) AS total FROM cases c JOIN case_images i ON c.id = i.case_id");
$countRow = $countResult->fetch_assoc();
$totalPages = ceil($countRow['total'] / 6);
?>

    <!--* ======================================================== start cases ======================================== -->
    <section class="Cases" id="up">
      <div class="container mt-4">
        <div class="row">
            <!-- زر الفلترة في الشاشات الصغيرة -->
            <div class="d-lg-none mb-3 position-relative">
                <button class="btn  btn-show-filter w-100" id="toggleFilter">Filter</button>
                <div class="dropdown-menu p-3 w-100" id="filterMenu" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050;">
                    <a class="btn btn-filter1 w-100 mb-2 filter-btn" href="cases.php?category=medical">Med</a>
                    <a class="btn btn-filter2 w-100 mb-3 filter-btn" href="cases.php?category=dental">Dental</a>
                    <form method="GET" action="cases.php">
                        <div class="mb-3">
                            <label for="filterTags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="filterTags" name="tags" value="<?= htmlspecialchars($filterTags ?? '') ?>" placeholder="e.g. dental, xray" onkeydown="if(event.key === 'Enter'){this.form.submit();}">
                        </div>
                    </form>
                    <a href="cases.php" class="btn btn-danger w-100 mt-3">Clear Filter</a>
                    <button class="btn btn-creation w-100 mt-3 " onclick="window.location.href ='createACase.php'"> Create a Case</button>
                  </div>
                </div>
                
                <!-- الفلتراشن في الشاشه الكبيره -->
                <div class="col-lg-3 d-none d-lg-block">
                  <div class="bg-white px-3 py-5">
                    <a class="btn btn-filter1 w-100 mb-2 filter-btn" href="cases.php?category=medical">Med</a>
                    <a class="btn btn-filter2 w-100 mb-3 filter-btn" href="cases.php?category=dental">Dental</a>
                    <form method="GET" action="cases.php">
                        <div class="mb-3">
                            <label for="filterTags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="filterTags" name="tags" value="<?= htmlspecialchars($filterTags ?? '') ?>" placeholder="e.g. dental, xray" onkeydown="if(event.key === 'Enter'){this.form.submit();}">
                        </div>
                    </form>
                    <a href="cases.php" class="btn btn-danger w-100 mt-3">Clear Filter</a>
                    <button class="btn btn-creation w-100 mt-3 " onclick="window.location.href ='createACase.php'"> Create a Case</button>
                </div>
            </div>
            
            <!-- Cards -->
            <div class="col-lg-9">
                <div class="row" id="cardsContainer">
          <?php
              if (
                isset($_SESSION['user_id']) &&
                in_array($_SESSION['role'], ['doctor', 'patient']) &&
                $_SESSION['active']
              ):
          while ($row = $result->fetch_assoc()):
              $donationQuery = $conn->query("SELECT SUM(amount) AS total FROM donations WHERE case_id = " . (int)$row['id']);
              $donationRow = $donationQuery->fetch_assoc();
              $raised = $donationRow['total'] ?? 0.00;
              $doctorName = null;
              $doctorResult = $conn->query("SELECT CONCAT(first_name, ' ', last_name) AS name FROM users WHERE id = (SELECT doctor_id FROM cases WHERE id = " . (int)$row['id'] . ")");
              if ($doctorResult && $doctorRow = $doctorResult->fetch_assoc()) {
                  $doctorName = $doctorRow['name'];
              }
              ?>
            <div class="col-md-6 col-lg-4 mb-4 case-card" data-category="<?= ucfirst($row['category']) ?>" id="case-<?= $row['id'] ?>">
              <div class="card card-case">
                <img src="<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                <div class="card-body case-card-body">
                  <h5 class="card-title case-card-title d-flex justify-content-between">
                    <?= htmlspecialchars($row['title']) ?>
                    <span class="badge bg-secondary"><?= ucfirst($row['category']) ?></span>
                  </h5>
                  <p class="card-text case-card-text"><?= htmlspecialchars(substr($row['description'], 0, 75)) ?>...</p>
                  <div class="tags">
                      <strong>Tags:</strong> 
                      <?php
                      $tags = explode(',', $row['tags']);
                      foreach ($tags as $tag) {
                          echo "<span class='tst  badge  me-1'>" . htmlspecialchars(trim($tag)) . "</span>";
                      }
                      ?>
                  </div>

          <?php
          $progressPercent = $row['target_amount'] > 0 ? min(100, ($raised / $row['target_amount']) * 100) : 0;
          ?>
          <?php if ($doctorName): ?>
              <p class="mb-1" style="height: 55px;"><strong>Assigned Doctor:</strong> <?= htmlspecialchars($doctorName) ?></p>
          <?php endif; ?>
          <div class="progress mb-2" style="height: 6px;">
              <div class="progress-bar" role="progressbar" style="width: <?= $progressPercent ?>%;" aria-valuenow="<?= $progressPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="mt-2">
              £<?= number_format($raised, 2) ?> raised of £<?= number_format($row['target_amount'], 2) ?> target
          </p>
          <div class="d-flex justify-content-between mt-auto">
                      <button class="btn case-btn btn-take" 
                              data-bs-toggle="modal" 
                              data-bs-target="#takeModal"
                              data-title="<?= htmlspecialchars($row['title']) ?>"
                              data-description="<?= htmlspecialchars($row['description']) ?>"
                              data-image="<?= htmlspecialchars($row['image_url']) ?>"
                              data-category="<?= ucfirst($row['category']) ?>"
                              data-tags="<?= htmlspecialchars($row['tags']) ?>"
                              data-raised="<?= $raised ?>"
                              data-target="<?= $row['target_amount'] ?>"
                              <?= ($_SESSION['role'] !== 'doctor') ? 'disabled' : '' ?>>
                          Take the Case
                      </button>
                      <button class="btn case-btn btn-help" 
                              data-bs-toggle="modal" 
                              data-bs-target="#helpModal"
                              data-title="<?= htmlspecialchars($row['title']) ?>"
                              data-image="<?= htmlspecialchars($row['image_url']) ?>"
                              data-case-id="<?= $row['id'] ?>"
                              data-target="<?= $row['target_amount'] ?>"
                              data-raised="<?= $raised ?>"
                              <?= ($_SESSION['role'] !== 'patient') ? 'disabled' : '' ?>>
                          Help
                      </button>
                      </div>
                </div>
              </div>
            </div>
          <?php endwhile;  else: ?>
            <div class="col-12">
        <div class="alert alert-warning text-center">You must Sign in to view available cases.</div>
      </div>
    <?php endif; ?>
                </div>
                <div class="pagination">
                    <!-- Previous Page Button -->
                    <?php if ($page > 1): ?>
                        <a href="cases.php?page=<?= $page - 1 ?>&tags=<?= htmlspecialchars($filterTags ?? '') ?>" class="btn btn-pagination">Previous</a>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);

                    for ($i = $startPage; $i <= $endPage; $i++):
                        $activeClass = ($i === $page) ? 'active' : '';
                    ?>
                        <a href="cases.php?page=<?= $i ?>&tags=<?= htmlspecialchars($filterTags ?? '') ?>" class="btn btn-pagination <?= $activeClass ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Next Page Button -->
                    <?php if ($page < $totalPages): ?>
                        <a href="cases.php?page=<?= $page + 1 ?>&tags=<?= htmlspecialchars($filterTags ?? '') ?>" class="btn btn-pagination">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
      </div>
    </section>
<!--! ======================================================== end cases ======================================== -->
<!--? ======================================================== start modals ======================================== -->
<!--* ======================================================== start help modal ======================================== -->
    <div class="modal fade" id="helpModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="d-flex align-items-center">
            <img id="helpModalImage" src="" alt="Case Image" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
            <h5 class="modal-title ps-3" id="helpModalLabel"> </h5>
          </div>
              <p class="modal-description px-3 py-1"> </p>
              <form class="donation-form" method="POST" action="donate.php">
                <input type="hidden" name="case_id" id="donation-case-id">
                <div class="modal-body">
                  <div class="currency-container ">
                    <select class="form-select currency-select" name="currency">
                      <option value="GBP">GBP</option>
                      <option value="USD" selected>USD</option>
                      <option value="EUR">EUR</option>
                      <option value="JPY">JPY</option>
                      <option value="AUD">AUD</option>
                    </select>
                    <input type="text" class="amount-input" placeholder="Amount" name="amount">
                  </div>
                  <div class="progress my-4" style="height: 7px;">
                    <div class="progress-bar" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-2">£4,783.32 raised of £10,000 target</p>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="hideAmount">
                    <label class="form-check-label" for="hideAmount">Hide donation amount from public view</label>
                  </div>
                  <button type="submit" class="btn btn-Continue mt-3">DONATE</button>
                </div>
              </form>
              <div class="donation-footer">
                <p class="mb-1">DONATE WITH CONFIDENCE</p>
                <div class="icon-container">
                  <p class="footer-paragraph">No platform fees for partners <i class="fa-solid fa-heart"></i></i></p>
                  <p class="footer-paragraph footer-line"> Trusted by millions <i class="fa-solid fa-globe"></i></i></p>
                  <p class="footer-paragraph footer-line"> 100% secure payments <i class="fas fa-lock"></i></p> 
                </div>
              </div>
            </div>
          </div>
        </div>
<!--! ======================================================== end help modal ======================================== -->
<!--* ======================================================== start take modal ======================================== -->
<div class="modal fade" id="takeModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="takeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <div class="modal-left" style="flex: 1; padding-right: 20px;">
                    <h5 class="modal-title" id="takeModalLabel"></h5>
                    <p class="modal-description"></p>
                    <h6 class="modal-category"></h6> <!-- For the case category -->
                    <div class="modal-tags"></div> <!-- Tags will be displayed here -->
                    <div class="modal-donation-info mt-3">
                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="mt-2 donation-text">£0.00 raised of £0.00 target</p>
                    </div>
                    <form method="POST" action="assign_case.php">
                        <input type="hidden" name="case_id" id="assign-case-id">
                        <button type="submit" class="btn btn-primary mt-3">Assign Case to Me</button>
                    </form>
                </div>
                <div class="modal-right" style="flex: 0.5; display: flex; justify-content: center;">
                    <img class="img-fluid rounded-2" alt="Case Image" style="max-height: 200px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</div>
<!--! ======================================================== end take modal ======================================== -->
<!--? ======================================================== end modals ======================================== -->
<!--* ======================================================== start footer ======================================== -->
<?php include 'footer.php'; ?>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Filter Button in mobile
  document
    .getElementById("toggleFilter")
    .addEventListener("click", function () {
      let filterMenu = document.getElementById("filterMenu");
      filterMenu.style.display =
        filterMenu.style.display === "none" ? "block" : "none";
    });
$('#takeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var title = button.data('title'); // Extract case title
    var description = button.data('description'); // Extract case description
    var image = button.data('image'); // Extract case image URL
    var category = button.data('category'); // Extract case category
    var tags = button.data('tags'); // Extract case tags

    var modal = $(this);

    // Set the modal content
    modal.find('.modal-title').text(title);
    modal.find('.modal-description').text(description);
    
    // Update the image src and ensure the modal shows the correct image
    var modalImage = modal.find('.modal-body img');
    if (image) {
        modalImage.attr('src', image).show();
    } else {
        modalImage.attr('src', 'default-image.jpg').show();  // Fallback image
    }
    modal.find('.modal-category').text(category);

    // Format and display tags
    var tagsArray = tags.split(',');
    var tagsHtml = '<strong>Tags:</strong><br>';
    tagsArray.forEach(function(tag) {
        tagsHtml += '<span class="badge bg-info me-1">' + tag.trim() + '</span>';
    });
    modal.find('.modal-tags').html(tagsHtml);

    var raised = button.data('raised');
    var target = button.data('target');
    var caseId = button.closest('.case-card').attr('id').split('-')[1];

    modal.find('#assign-case-id').val(caseId);

    var progress = Math.min((raised / target) * 100, 100);
    modal.find('.modal-donation-info .progress-bar')
         .css('width', progress + '%')
         .attr('aria-valuenow', progress);
    modal.find('.modal-donation-info .donation-text')
         .text('£' + parseFloat(raised).toFixed(2) + ' raised of £' + parseFloat(target).toFixed(2) + ' target');
});

$('#helpModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var raised = button.data('raised');
    var target = button.data('target');
    var title = button.data('title');
    var image = button.data('image');
    var currency = '£'; // Default symbol

    var modal = $(this);
    modal.find('.modal-title').text(button.data('title'));

    // Set image
    if (image) {
        modal.find('#helpModalImage').attr('src', image).show();
    } else {
        modal.find('#helpModalImage').hide(); // Or show fallback
    }

    // Populate the donation case ID
    modal.find('#donation-case-id').val(button.data('case-id'));

    // Update the progress bar
    modal.find('.progress-bar')
         .css('width', Math.min((raised / target) * 100, 100) + '%')
         .attr('aria-valuenow', raised);

    // Update the raised/target text
    modal.find('.modal-body p.mt-2')
         .text(currency + parseFloat(raised).toFixed(2) + ' raised of ' + currency + parseFloat(target).toFixed(2) + ' target');
});
</script>