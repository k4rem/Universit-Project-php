document.addEventListener("DOMContentLoaded", function () {

// ====================================================
// Cases info
// ====================================================
  let cardsContainer = document.getElementById("cardsContainer");

  let casesData = [
    {
      id: 1,
      category: "Med",
      title: "An Itchy, Slow-Growing Infant",
      description:
        "generally dry skin, with widespread low-grade erythema and raised, poorly defined patches of active eczema; there are widespread excoriations.",
      image: "imgs/med1.jpg",
    },
    {
      id: 2,
      category: "Dental",
      title: "Curved Roots Case",
      description:
        "The challenges of treating this upper 6 with curved roots and calcified pulp and canals.",
      image: "imgs/dental1.jpg",
    },
    {
      id: 3,
      category: "Med",
      title: "A Toddler With Brown Patches",
      description:
        "His height and weight are on the 75th and 91st centiles for his age, respectively. He is cooperative and follows directions. He has diffuse, scattered, monomorphic, small oval-round reddish-brown macules concentrated predominantly over his anterior and posterior trunk, but also extending to his neck and with a few scattered lesions on his limbs. There are more than 40 of these lesions.",
      image: "imgs/med2.jpg",
    },
    {
      id: 4,
      category: "Dental",
      title: "Deep Canal Divisions ",
      description:
        "This maxilliary first molar had a wide, blunt palatal root and this can hint at the presence of complex anatomy.",
      image: "imgs/dental2.jpg",
    },
    {
      id: 5,
      category: "Dental",
      title: "Exceptionally Long Roots",
      description:
        "This 32mm long lower canine shows unusual and sudden canal obliteration at mid-root level.",
      image: "imgs/dental3.jpg",
    },
    {
      id: 6,
      category: "Med",
      title: "Uterine Fibroids / Leiomyomas",
      description:
        "Fibroid in a 16 year old girl.",
      image: "imgs/med3.jpg",
    },
    {
      id: 7,
      category: "Med",
      title: "Dermoid Cysts / Cystic Teratomas",
      description:
        "Tordated dermoid cyst or teratoma simplex.",
      image: "imgs/med4.jpg",
    },
    {
      id: 8,
      category: "Dental",
      title: "Clinical Orthodontics",
      description:
        "crowding in the dental arches as well as eruption of teeth 27, 37 and 47. Tooth 17 was not visible. An OPG X-ray revealed that teeth 17 and 18 were stacked on top of one another.",
      image: "imgs/dental4.jpg",
    },
    {
      id: 9,
      category: "Dental",
      title: "Lower Jaw Is Too Far Forward",
      description:
        " 8-year-, 5-month-old female Concave and forward sloping, facial profile secondary to apparent mandibular prognathia Otherwise, fairly symmetrical facial features. ",
      image: "imgs/dental5.jpg",
    },
  ];

  // Random Sorting ( Medical, Dental )
  casesData = casesData.sort(() => Math.random() - 0.5);

// ====================================================
// Create Cards in the DOM
// ====================================================
  casesData.forEach((caseItem) => {
    let card = document.createElement("div");
    card.className = "col-md-6 col-lg-4 mb-4 case-card";
    card.setAttribute("data-category", caseItem.category);
    card.setAttribute("id", `case-${caseItem.id}`); // إضافة id لكل كارد
    card.innerHTML = `
            <div class="card">
                <img src="${caseItem.image}" class="card-img-top" alt="${caseItem.title}">
                <div class="card-body">
                    <h5 class="card-title  d-flex justify-content-between">
                        ${caseItem.title} <span class="badge bg-secondary">${caseItem.category}</span>
                    </h5>
                    <p class="card-text">${caseItem.description}</p>
                    <div class="  d-flex justify-content-between">
                        <button class="btn case-btn btn-take" data-bs-toggle="modal" data-bs-target="#takeModal">Take the Case</button>
                        <button class="btn case-btn btn-help"  data-bs-toggle="modal" data-bs-target="#helpModal" >Help</button>
                    </div>
                </div>
            </div>`;
    cardsContainer.appendChild(card);
  });
// ====================================================
// Filtering Cards (Medical, Dental)
// ====================================================
  document.querySelectorAll(".filter-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let category = this.getAttribute("data-category");
      filterCards(category);
    });
  });

  function filterCards(category) {
    document.querySelectorAll(".case-card").forEach((card) => {
      if (card.getAttribute("data-category") === category) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  }
// =========================
// Remove Filter
  document.querySelectorAll(".removeFilter").forEach((button) => {
    button.addEventListener("click", function () {
      document.querySelectorAll(".case-card").forEach((card) => {
        card.style.display = "block";
      });
    });
  });


// =========================
// Filter Button in mobile
  document
    .getElementById("toggleFilter")
    .addEventListener("click", function () {
      let filterMenu = document.getElementById("filterMenu");
      filterMenu.style.display =
        filterMenu.style.display === "none" ? "block" : "none";
    });
// ====================================================
// Modals (Help & Take)
// ====================================================

// Help Modal
  document.querySelectorAll(".card").forEach((card) => {
    card.addEventListener("click", function () {
      // دا عشان اخد النص من h5منغير مخلي ال Span تظهر
      const title = card.querySelector(".card-title").innerHTML.replace(/<span.*?>.*?<\/span>/g, "");
      const description = card.querySelector(".card-text").innerHTML;

      // update title and description in the modal
      document.querySelector(".modal-title").innerText = title;
      document.querySelector(".modal-description").innerText = description;
    });
  });

  // Take Modal
  document.querySelectorAll(".btn-take").forEach((button) => {
    button.addEventListener("click", function () {
      let card = this.closest(".card"); // البحث عن العنصر الأب (الكارد)

      let title = card.querySelector(".card-title").childNodes[0].nodeValue.trim();
      let description = card.querySelector(".card-text").innerText;
      let imageSrc = card.querySelector(".card-img-top").src;

      // update title , discription and image in the modal
      document.querySelectorAll("#takeModalLabel").forEach((el) => (el.innerText = title));
      document.querySelectorAll("#takeModal .modal-description").forEach((el) => (el.innerText = description));
      document.querySelectorAll("#takeModal img").forEach((el) => (el.src = imageSrc));
    });
  });
});
// ====================================================
// to close navbar-collapse on click
// ====================================================
const navLinks = document.querySelectorAll(".navbar-nav a");
navLinks.forEach((link) => {
  link.addEventListener("click", function () {
    const collapse = document.querySelector(".navbar-collapse");
    const bsCollapse = new bootstrap.Collapse(collapse, { hide: true });
  });
});

const btnLogin = document.querySelectorAll(".navbar .btn-login");
btnLogin.forEach((button) => {
  button.addEventListener("click", function () {
    const collapse = document.querySelector(".navbar-collapse");
    const bsCollapse = new bootstrap.Collapse(collapse, { hide: true });
  });
  // ====================================================
  //   to toggle color of nav button
  // ====================================================
  const btnToggle = document.getElementById("toggle-color");
  btnToggle.addEventListener("click", function () {
    btnToggle.classList.toggle("toggled");
  });
});
