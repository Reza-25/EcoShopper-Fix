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







// Filter section toggle
const filterIcon = document.getElementById('filter-icon');
const filterSection = document.getElementById('filter-section');

filterIcon.addEventListener('click', function() {
  filterSection.style.display = filterSection.style.display === 'block' ? 'none' : 'block';
});

// Close the filter section if clicked outside
document.addEventListener('click', function(event) {
  if (!filterIcon.contains(event.target) && !filterSection.contains(event.target)) {
    filterSection.style.display = 'none';
  }
});