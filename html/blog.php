<?php include 'header.php'; ?>
    <!-- Hero Section -->
    <div class="hero-section" id="up">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Taazur Medical Blog</h1>
            <p class="lead">Trusted medical information and health advice from our experts</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Posts Column -->
            <div class="col-lg-8">
                <!-- Featured Post -->
                <div class="card blog-card mb-4">
                    <img src="imgs/featured-img.JPG" class="card-img-top" alt="Featured Post">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge badge-medical text-white">Cardiology</span>
                            <small class="text-muted">May 15, 2023</small>
                        </div>
                        <h2 class="card-title">Understanding Heart Disease: Prevention and Early Detection</h2>
                        <p class="card-text">Heart disease remains the leading cause of death worldwide. This comprehensive guide explores the latest prevention strategies and early detection methods that could save your life...</p>
                        <button  class="btn btn-primary priy-btn ">Read More</button>
                    </div>
                </div>

                <!-- Blog Post List -->
                <div class="row">
                    <!-- Post 1 -->
                    <div class="col-md-6 mb-4">
                        <div class="card blog-card h-100">
                            <img src="imgs/post1.JPG" class="card-img-top" alt="Post 1">
                            <div class="card-body">
                                <span class="badge badge-medical  mb-2">Pediatrics</span>
                                <h5 class="card-title">Childhood Vaccinations: What Every Parent Should Know</h5>
                                <p class="card-text">A complete guide to childhood immunization schedules, benefits, and addressing common concerns parents have about vaccines.</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <p class="text-muted d-inline-block">April 28, 2023</p>
                                <button  class="btn btn-sm btn-outline-primary float-end">Read</button>
                            </div>
                        </div>
                    </div>

                    <!-- Post 2 -->
                    <div class="col-md-6 mb-4">
                        <div class="card blog-card h-100">
                            <img src="imgs/post2.JPG" class="card-img-top" alt="Post 2">
                            <div class="card-body">
                                <span class="badge badge-medical  mb-2">Nutrition</span>
                                <h5 class="card-title">The Mediterranean Diet: Science-Backed Benefits</h5>
                                <p class="card-text">Explore why the Mediterranean diet is consistently ranked as one of the healthiest eating patterns and how to adopt it.</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <p class="text-muted d-inline-block">April 20, 2023</p>
                                <button  class="btn btn-sm btn-outline-primary float-end">Read</button>
                            </div>
                        </div>
                    </div>

                    <!-- Post 3 -->
                    <div class="col-md-6 mb-4">
                        <div class="card blog-card h-100">
                            <img src="imgs/post3.JPG" class="card-img-top" alt="Post 3">
                            <div class="card-body">
                                <span class="badge badge-medical mb-2">Mental Health</span>
                                <h5 class="card-title">Managing Anxiety in Post-Pandemic Times</h5>
                                <p class="card-text">Effective strategies for coping with increased anxiety levels as we navigate the post-pandemic world.</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <p class="text-muted d-inline-block">April 12, 2023</p>
                                <button  class="btn btn-sm btn-outline-primary float-end">Read</button>
                            </div>
                        </div>
                    </div>

                    <!-- Post 4 -->
                    <div class="col-md-6 mb-4">
                        <div class="card blog-card h-100">
                            <img src="imgs/post4.JPG" class="card-img-top" alt="Post 4">
                            <div class="card-body">
                                <span class="badge badge-medical mb-2">Emergency Medicine</span>
                                <h5 class="card-title">First Aid Basics Everyone Should Know</h5>
                                <p class="card-text">Essential first aid techniques that could help you save a life before professional help arrives.</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <p class="text-muted d-inline-block">April 5, 2023</p>
                                <button  class="btn btn-sm btn-outline-primary float-end">Read</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <!-- About Card -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h3 class="card-title">About Our Blog</h3>
                        <p class="card-text">Our medical blog provides evidence-based health information written by our team of board-certified physicians and healthcare professionals.</p>
                        <button class="btn btn-primary priy-btn">Meet Our Authors</button>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h3 class="card-title">Categories</h3>
                        <ul class="category-list">
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Cardiology</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Pediatrics</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Nutrition</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Mental Health</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Dermatology</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Emergency Medicine</a></li>
                            <li><a ><i class="fa-regular fa-circle-right me-2"></i>Preventive Care</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter Card -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h3 class="card-title">Subscribe to Newsletter</h3>
                        <p class="card-text">Get the latest health tips and medical news delivered to your inbox.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address">
                            </div>
                            <button type="button" class="btn btn-primary priy-btn w-100">Subscribe</button>
                        </form>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="card sidebar-card">
                    <div class="card-body">
                        <h4 class="card-title">Popular Tags</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <a class="btn btn-sm btn-outline-secondary">Diabetes</a>
                            <a class="btn btn-sm btn-outline-secondary">Heart Health</a>
                            <a class="btn btn-sm btn-outline-secondary">COVID-19</a>
                            <a class="btn btn-sm btn-outline-secondary">Exercise</a>
                            <a class="btn btn-sm btn-outline-secondary">Sleep</a>
                            <a class="btn btn-sm btn-outline-secondary">Vaccines</a>
                            <a class="btn btn-sm btn-outline-secondary">Mental Wellness</a>
                            <a class="btn btn-sm btn-outline-secondary">Aging</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--* ======================================================== start footer ======================================== -->
    <?php include 'footer.php'; ?>