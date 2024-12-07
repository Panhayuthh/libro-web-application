document.querySelector('.sidebar-toggler').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('sidebar-narrow');
});

document.addEventListener("DOMContentLoaded", () => {
    // Increment button logic
    document.querySelectorAll(".button-plus").forEach(button => {
        button.addEventListener("click", function () {
            const parent = this.closest(".input-group");
            const input = parent.querySelector(".quantity-field");
            const max = parseInt(input.getAttribute("max"), 10) || 10;
            let value = parseInt(input.value, 10) || 1;

            if (value < max) {
                input.value = value + 1;
            }
        });
    });

    // Decrement button logic
    document.querySelectorAll(".button-minus").forEach(button => {
        button.addEventListener("click", function () {
            const parent = this.closest(".input-group");
            const input = parent.querySelector(".quantity-field");
            let value = parseInt(input.value, 10) || 1;

            if (value > 1) {
                input.value = value - 1;
            }
        });
    });
});