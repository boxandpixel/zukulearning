document.addEventListener('DOMContentLoaded', function () {
    const resetLink = document.querySelector('.reset_variations');
  
    const observer = new MutationObserver(() => {
      if (resetLink.style.visibility === 'hidden') {
        resetLink.style.display = 'none';
      } else {
        resetLink.style.display = 'inline'; // or 'block', depending on layout
      }
    });
  
    observer.observe(resetLink, { attributes: true, attributeFilter: ['style'] });
  
    // Trigger once on load
    if (resetLink.style.visibility === 'hidden') {
      resetLink.style.display = 'none';
    }
  });
  