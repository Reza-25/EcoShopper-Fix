var swiper = new Swiper(".home", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
});

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function() {
  const profileIcon = document.getElementById('profile-icon');
  const profileDropdown = document.getElementById('profile-dropdown');

  profileIcon.addEventListener('click', function() {
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', function(event) {
      if (!profileIcon.contains(event.target) && !profileDropdown.contains(event.target)) {
          profileDropdown.style.display = 'none';
      }
  });
});

