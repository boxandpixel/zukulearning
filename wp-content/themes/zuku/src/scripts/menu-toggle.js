// document.addEventListener('DOMContentLoaded', () => {
//   const toggleButton = document.querySelector('.site-header__menu-toggle');
//   const mainMenu = document.querySelector('#main-menu');
//   const utilityMenu = document.querySelector('.site-header__utility-menu--mobile #header-utility-menu');

//   if (toggleButton && mainMenu && utilityMenu) {
//     toggleButton.addEventListener('click', () => {
//       console.log("clicked");
//       mainMenu.classList.toggle('is-open');
//       utilityMenu.classList.toggle('is-open');
//       toggleButton.classList.toggle('is-open');
//       document.body.classList.toggle('menu-is-open');

//       // Accessibility toggle attributes
//       const expanded = toggleButton.getAttribute('aria-expanded') === 'true';
//       toggleButton.setAttribute('aria-expanded', String(!expanded));
//       mainMenu.setAttribute('aria-hidden', String(expanded));
//       utilityMenu.setAttribute('aria-hidden', String(expanded));
//     });

//     // Initialize ARIA attributes
//     toggleButton.setAttribute('aria-expanded', 'false');
//     mainMenu.setAttribute('aria-hidden', 'true');
//     utilityMenu.setAttribute('aria-hidden', 'true');
//   }

//   // Mega menu toggle for items with children
//   const menuItems = document.querySelectorAll('#main-menu .menu-item.has-mega-menu > a');

//   menuItems.forEach(link => {
//     link.addEventListener('click', (e) => {
//       // Optional: prevent default navigation if needed
//       e.preventDefault();

//       const parent = link.closest('.menu-item');

//       console.log(parent);

//       // Close other open mega menus (optional)
//       document.querySelectorAll('#main-menu .menu-item.has-mega-menu.is-open').forEach(item => {
//         if (item !== parent) {
//           item.classList.remove('is-open');
//         }
//       });

//       // Toggle this one
//       parent.classList.toggle('is-open');
//     });
//   });

//   // Breadcrumb behavior for mobile mega menu
//   const breadcrumbs = document.querySelectorAll('.mega-menu__breadcrumb');

//   breadcrumbs.forEach(breadcrumb => {
//     breadcrumb.addEventListener('click', (e) => {
//       e.preventDefault();

//       // Find any open mega menu item and close it
//       const openItem = document.querySelector('#main-menu .menu-item.has-mega-menu.is-open');
//       if (openItem) {
//         openItem.classList.remove('is-open');
//       }
//     });
//   });  

// });

document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.querySelector('.site-header__menu-toggle');
  const mainMenu = document.querySelector('#main-menu');
  const utilityMenu = document.querySelector('.site-header__utility-menu--mobile #header-utility-menu');

  if (toggleButton && mainMenu && utilityMenu) {
    toggleButton.addEventListener('click', () => {
      console.log("clicked");

      // Check if the menu is open
      const menuIsOpen = mainMenu.classList.contains('is-open');

      // Toggle the "is-open" class for the menus and button
      mainMenu.classList.toggle('is-open', !menuIsOpen);
      utilityMenu.classList.toggle('is-open', !menuIsOpen);
      toggleButton.classList.toggle('is-open', !menuIsOpen);
      document.body.classList.toggle('menu-is-open', !menuIsOpen);

      // Now check if the menu is actually closed after the toggle
      const menuIsNowOpen = mainMenu.classList.contains('is-open');

      // If closing the menu, remove "is-open" from all elements with mega menus
      if (!menuIsNowOpen) {
        console.log("menu is closed");
        // Remove "is-open" from all menu items with mega menus
        document.querySelectorAll('#main-menu .menu-item').forEach(item => {
          console.log("Removing is-open from item:", item);
          item.classList.remove('is-open');
        });
      }

      // Accessibility toggle attributes
      const expanded = toggleButton.getAttribute('aria-expanded') === 'true';
      toggleButton.setAttribute('aria-expanded', String(!expanded));
      mainMenu.setAttribute('aria-hidden', String(expanded));
      utilityMenu.setAttribute('aria-hidden', String(expanded));
    });

    // Initialize ARIA attributes
    toggleButton.setAttribute('aria-expanded', 'false');
    mainMenu.setAttribute('aria-hidden', 'true');
    utilityMenu.setAttribute('aria-hidden', 'true');
  }

  // Mega menu toggle for items with children
  const menuItems = document.querySelectorAll('#main-menu .menu-item.has-mega-menu > a');

  menuItems.forEach(link => {
    link.addEventListener('click', (e) => {
      // Optional: prevent default navigation if needed
      e.preventDefault();

      const parent = link.closest('.menu-item');

      // Close other open mega menus (optional)
      document.querySelectorAll('#main-menu .menu-item.has-mega-menu.is-open').forEach(item => {
        if (item !== parent) {
          item.classList.remove('is-open');
        }
      });

      // Toggle this one
      parent.classList.toggle('is-open');
    });
  });

  // Breadcrumb behavior for mobile mega menu
  const breadcrumbs = document.querySelectorAll('.mega-menu__breadcrumb');

  breadcrumbs.forEach(breadcrumb => {
    breadcrumb.addEventListener('click', (e) => {
      e.preventDefault();

      // Find any open mega menu item and close it
      const openItem = document.querySelector('#main-menu .menu-item.has-mega-menu.is-open');
      if (openItem) {
        openItem.classList.remove('is-open');
      }
    });
  });
});





