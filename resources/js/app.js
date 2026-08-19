window.toggleForm = function (id) {
    const form = document.getElementById(id);
    if (form) {
        form.classList.toggle('hidden');
    }
};

window.toggleEdit = function (hideId, showId) {
    const hideEl = document.getElementById(hideId);
    const showEl = document.getElementById(showId);
    if (hideEl && showEl) {
        hideEl.classList.add('hidden');
        showEl.classList.remove('hidden');
    }
};

window.updateRangeLabel = function (input) {
    const label = input.parentElement.querySelector('.range-label');
    if (label) {
        label.textContent = input.value + '%';
    }
};
