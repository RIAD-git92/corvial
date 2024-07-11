document.addEventListener('DOMContentLoaded', function () {
    const filterInput = document.getElementById('filterInput');
    const tableRows = document.querySelectorAll('#offresTable tr');
    const noResultsMessage = document.getElementById('noResultsMessage');

    filterInput.addEventListener('input', function () {
        const filterValue = this.value.toLowerCase().trim();
        
        if (!/^[a-zA-Z0-9\s]*$/.test(filterValue)) {
            filterInput.setCustomValidity("Seuls les lettres et chiffres sont autorisés.");
            filterInput.reportValidity();
            return;
        } else {
            filterInput.setCustomValidity("");
        }

        let visibleRowCount = 0;

        tableRows.forEach(function (row) {
            const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (title.includes(filterValue)) {
                row.style.display = '';
                visibleRowCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleRowCount === 0) {
            noResultsMessage.style.display = 'block';
        } else {
            noResultsMessage.style.display = 'none';
        }
    });
});
