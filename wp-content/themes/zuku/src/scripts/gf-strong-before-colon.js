document.addEventListener('DOMContentLoaded', function () {
    const labels = document.querySelectorAll('.ginput_container_checkbox label');
    labels.forEach(function (label) {
      const text = label.textContent;
      const colonIndex = text.indexOf(':');
      if (colonIndex !== -1) {
        const beforeColon = text.substring(0, colonIndex).trim();
        const afterColon = text.substring(colonIndex);
        label.innerHTML = `<strong>${beforeColon}</strong>${afterColon}`;
      }
    });
  });
  