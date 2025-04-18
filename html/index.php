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

$sql = "SELECT c.id, c.title, c.description, c.category, i.image_url 
        FROM cases c 
        JOIN case_images i ON c.id = i.case_id";

if ($filterCategory) {
    $sql .= " WHERE c.category = '" . $conn->real_escape_string($filterCategory) . "'";
}

$result = $conn->query($sql);
?>

    <!--* ======================================================== start landing ======================================== -->
    <section class="landing header" id="up">
      <div class="content">
        <h1>Do something</h1>
        <h1>incredible today</h1>
        <p>
          Every day is a chance to do something amazing. Start by making a small
          change, and who knows? It could lead to something life-changing.
        </p>
        <button class="btn main-btn btn-effect"><a style="color: black;" href="cases.php">See all cases</a></button>
      </div>
    </section>
    <!--! ======================================================== end landing ======================================== -->
    <!--* ======================================================== start cases ======================================== -->
    <section class="successful-cases py-5">
      <div class="container">
        <h2 class="sec-title text-center mb-5">Successful Cases</h2>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card index-card">
              <img src="imgs/case1.jpg" alt="Case 1" />
              <div class="card-body">
                <h5 class="index-card-title">Bringing Hope to Children</h5>
                <p class="index-card-text">
                  Providing education and healthcare to underprivileged
                  children, ensuring a brighter future for the next generation.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card index-card">
              <img src="imgs/case2.jpg" alt="Case 2" />
              <div class="card-body">
                <h5 class="index-card-title">Healing in Action</h5>
                <p class="index-card-text">
                  Delivering essential medical aid and support to those in need,
                  ensuring proper care and recovery for every patient.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card index-card">
              <img src="imgs/case3.jpg" alt="Case 3" />
              <div class="card-body">
                <h5 class="index-card-title">Bridging Generations  </h5>
                <p class="index-card-text">
                  Connecting volunteers with elderly individuals to provide
                  companionship, care, and a sense of community.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card index-card">
              <img src="imgs/case4.jpg" alt="Case 4" />
              <div class="card-body">
                <h5 class="index-card-title">Empowering the Young </h5>
                <p class="index-card-text">
                  Engaging children in educational and creative activities that
                  inspire learning and personal growth.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--! ======================================================== end cases ======================================== -->
    <!--* ======================================================== start doctors ======================================== -->
    <section class="doctors" id="doctors">
      <div class="container swiper">
        <h2 class="sec-title text-white text-center mb-5 doctors-title">
          Popular Doctors
        </h2>
        <div class="slider-wrapper">
          <div class="card-list swiper-wrapper">
            <div class="card-item swiper-slide">
              <img src="imgs/user1.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Mohamed Ahmed</h2>
              <p class="user-profession">Neurosurgery</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user2.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Rana Mohamed</h2>
              <p class="user-profession">Anesthesiology</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user3.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">zain Ahmed</h2>
              <p class="user-profession">Plastic Surgery</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user4.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Ola Ahmed </h2>
              <p class="user-profession">Orthopedic Surgery</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user5.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Ragy Mansor</h2>
              <p class="user-profession">Cardiology</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user6.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Mariam Ahmed </h2>
              <p class="user-profession">Pediatrics</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user7.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Hany Naser</h2>
              <p class="user-profession">Emergency Medicine</p>
              <button class="message-button">Message</button>
            </div>
            <div class="card-item swiper-slide">
              <img src="imgs/user8.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Malak Ahmed</h2>
              <p class="user-profession">Ophthalmology</p>
              <button class="message-button">Message</button>
            </div>
            <!-- <div class="card-item swiper-slide">
              <img src="imgs/user9.jpg" alt="User Image" class="user-image" />
              <h2 class="user-name">Alex Anderson</h2>
              <p class="user-profession">Psychiatry</p>
              <button class="message-button">Message</button>
            </div> -->
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-slide-button swiper-button-prev"></div>
          <div class="swiper-slide-button swiper-button-next"></div>
        </div>
      </div>
    </section>
    <!--! ======================================================== end doctors ======================================== -->
    <!--* ======================================================== start vision ======================================== -->
    <section class="vision">
      <div class="container text-center my-5">
        <h2 class="sec-title vision-title mb-5">Our Vision</h2>
        <div class="row g-4 my-5">
          <div class="col-md-6">
            <div class="vision-card p-4 position-relative">
              <i class="fas fa-hand-holding-heart vision-icon"></i>
              <h5>Help people in need</h5>
              <p>
                Provide direct support to an individual, family or community by
                paying medical expenses or offering financial aid.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vision-card p-4 position-relative">
              <i class="fas fa-ambulance vision-icon"></i>
              <h5>Take action in an emergency</h5>
              <p>
                Raise funds in response to a natural disaster or humanitarian
                crisis. Make a difference in minutes.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vision-card p-4 position-relative">
              <i class="fas fa-medal vision-icon"></i>
              <h5>Take part in a charity</h5>
              <p>
                Choose from hundreds of official events including marathons,
                bike rides, Dryathlons and bake offs…
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vision-card p-4 position-relative">
              <i class="fas fa-birthday-cake vision-icon"></i>
              <h5>Celebrate an occasion</h5>
              <p>
                Mark a special event like a birthday, wedding or final exam by
                asking friends for donations rather than gifts.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--! ======================================================== end vision ================================================ -->
    <!--* ======================================================== start collaborations ======================================== -->
    <section class="collaborations">
      <div class="container text-center">
        <h5>hospitals and pharmacies on Taazur</h5>
      </div>
      <div class="container">
        <img
          class=""
          src="./imgs/Collaborations.png"
          alt=""
          draggable="false"
        />
      </div>
    </section>
<?php include 'footer.php'; ?>