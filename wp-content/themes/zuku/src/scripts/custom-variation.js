document.addEventListener('DOMContentLoaded', function () {
    // Add a parent class to the variations form for scoping the styles
    var productContainer = document.querySelector('form.variations_form');
    if (!productContainer) return;

    productContainer.classList.add('course-variation');

    // Convert Course Type to Tabs (Radio Buttons)
    var courseTypeSelect = productContainer.querySelector('select[name="attribute_course-type"]');
    if (!courseTypeSelect) return;

    var options = Array.from(courseTypeSelect.options);
    var tabsContainer = document.createElement('div');
    tabsContainer.classList.add('course-type-tabs');

    options.forEach(function (option) {
        var optionValue = option.value;
        if (optionValue) {
            var tab = document.createElement('div');
            tab.classList.add('course-type-tab');
            tab.textContent = option.textContent;
            tab.setAttribute('data-value', optionValue);
            tabsContainer.appendChild(tab);
        }
    });

    // Insert tabsContainer after the courseTypeSelect dropdown
    courseTypeSelect.parentNode.insertBefore(tabsContainer, courseTypeSelect.nextSibling);

    // Hide the original select visually, but keep it in the DOM
    courseTypeSelect.style.position = 'absolute';
    courseTypeSelect.style.width = '1px';
    courseTypeSelect.style.height = '1px';
    courseTypeSelect.style.padding = '0';
    courseTypeSelect.style.margin = '-1px';
    courseTypeSelect.style.overflow = 'hidden';
    courseTypeSelect.style.clip = 'rect(0, 0, 0, 0)';
    courseTypeSelect.style.border = '0';

    // Clear the initial selection (no tab selected by default)
    courseTypeSelect.value = '';
    courseTypeSelect.dispatchEvent(new Event('change', { bubbles: true }));

    // Tab click handler
    tabsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('course-type-tab')) {
            var value = event.target.getAttribute('data-value');
            courseTypeSelect.value = value;
            courseTypeSelect.dispatchEvent(new Event('change', { bubbles: true }));

            // Highlight selected tab
            tabsContainer.querySelectorAll('.course-type-tab').forEach(function (tab) {
                tab.classList.remove('selected');
            });
            event.target.classList.add('selected');
        }
    });

    // Optional: Log the change for debugging
    courseTypeSelect.addEventListener('change', function () {
        console.log('Course type changed:', courseTypeSelect.value);
    });
});
