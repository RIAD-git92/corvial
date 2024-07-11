document.addEventListener('DOMContentLoaded', function () {
  const filterInput = document.getElementById('filterInput');
  const contratFilter = document.getElementById('contratFilter');
  const tableRows = document.querySelectorAll('#offresTable tr');
  const noResultsMessage = document.getElementById('noResultsMessage');
  const resetFilters = document.getElementById('resetFilters');

  function filterOffers() {
      const filterValue = filterInput.value.toLowerCase();
      const contratValue = contratFilter.value;
      
      let visibleRowCount = 0;

      tableRows.forEach(function (row) {
          const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
          const contrat = row.querySelector('td:nth-child(3)').textContent;

          const matchesFilter = title.includes(filterValue) && (contratValue === "" || contrat.includes(contratValue));

          if (matchesFilter) {
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
  }

  filterInput.addEventListener('input', filterOffers);
  contratFilter.addEventListener('change', filterOffers);
  resetFilters.addEventListener('click', function () {
      filterInput.value = '';
      contratFilter.value = '';
      filterOffers();
  });

  filterOffers(); 
});
