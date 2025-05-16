window.onload = function () {
    const labels = document.querySelectorAll('.ginput_container_checkbox label');
    labels.forEach(function (label) {
      console.log("label");
      const span = document.createElement('span');
      span.textContent = label.textContent;
      label.textContent = ''; // Clear existing text
      label.appendChild(span);
    });
  };
  