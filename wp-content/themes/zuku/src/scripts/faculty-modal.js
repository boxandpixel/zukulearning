document.addEventListener('DOMContentLoaded', function () {
    // Open modal
    document.querySelectorAll('.faculty-member__trigger').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.closest('.faculty-member').dataset.modalId;
            const modal = document.getElementById(modalId);

            if (modal) {
                modal.style.display = 'flex'; // Ensure the modal is visible
                document.body.style.overflow = 'hidden'; // Prevent background scroll

                setTimeout(() => {
                    modal.querySelector('.faculty-modal__content').classList.add('visible'); // Trigger fade-in animation
                    modal.style.visibility = 'visible'; // Ensure visibility is set
                    modal.style.opacity = 1; // Fade-in the modal
                }, 10); // Small delay to trigger transition
            }
        });
    });

    // Close modal
    document.querySelectorAll('[data-modal-close]').forEach(el => {
        el.addEventListener('click', function () {
            const modal = this.closest('.faculty-modal');
            modal.querySelector('.faculty-modal__content').classList.remove('visible'); // Hide modal with animation
            modal.style.opacity = 0; // Fade-out the modal
            modal.style.visibility = 'hidden'; // Hide modal after animation completes
            document.body.style.overflow = ''; // Re-enable background scroll

            setTimeout(() => modal.style.display = 'none', 300); // Wait for animation to finish
        });
    });

    // Optional: Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.faculty-modal:not([style*="display: none"])').forEach(modal => {
                modal.querySelector('.faculty-modal__content').classList.remove('visible');
                modal.style.opacity = 0;
                modal.style.visibility = 'hidden';
                document.body.style.overflow = ''; // Re-enable scroll
                setTimeout(() => modal.style.display = 'none', 300);
            });
        }
    });
});
