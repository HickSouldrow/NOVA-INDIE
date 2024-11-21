window.onclick = function(event) {
    if (!event.target.matches('[onclick="toggleDropdown()"]') && !event.target.closest('#dropdown-menu')) {
        const dropdowns = document.getElementsByClassName("hidden");
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (!openDropdown.classList.contains('hidden')) {
                openDropdown.classList.add('hidden');
            }
        }
    }
}