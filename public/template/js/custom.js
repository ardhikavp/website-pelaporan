document.addEventListener('DOMContentLoaded', function () {
    // Function to handle modal show/hide
    var fotoLinks = document.querySelectorAll('.link-secondary');
    fotoLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var modalId = link.getAttribute('data-bs-target');
            var fotoModal = new bootstrap.Modal(document.querySelector(modalId));
            fotoModal.show();
        });
    });

    // Function to handle modal close (x button)
    var modalCloseButtons = document.querySelectorAll('.modal .btn-close');
    modalCloseButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var modal = button.closest('.modal');
            var fotoModal = bootstrap.Modal.getInstance(modal);
            fotoModal.hide();
        });
    });
});
