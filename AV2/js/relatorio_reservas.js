document.addEventListener('DOMContentLoaded', () => {
  const filterForm = document.getElementById('filter-form');

  // Função para carregar reservas com ou sem filtros
  function loadReservations(startDate = null, endDate = null) {
    let url = 'php/relatorio_reservas.php';
    if (startDate && endDate) {
      url += `?start=${startDate}&end=${endDate}`;
    }

    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        const tableBody = document.querySelector('#reservations-report tbody');
        tableBody.innerHTML = '';

        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="6">Nenhuma reserva encontrada.</td></tr>`;
          return;
        }

        data.forEach((reservation) => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${reservation.id}</td>
            <td>${reservation.client_name}</td>
            <td>${reservation.start_date}</td>
            <td>${reservation.end_date}</td>
            <td>${reservation.room_type}</td>
            <td>${reservation.status}</td>
          `;
          tableBody.appendChild(row);
        });
      })
      .catch((error) => {
        console.error('Erro ao carregar as reservas:', error);
        alert('Erro ao carregar os dados do relatório.');
      });
  }

  // Filtrar relatórios com base nas datas
  filterForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const startDate = document.getElementById('date-start').value;
    const endDate = document.getElementById('date-end').value;

    if (startDate && endDate) {
      loadReservations(startDate, endDate);
    } else {
      alert('Por favor, preencha as datas de início e fim.');
    }
  });

  // Carregar todas as reservas ao abrir a página
  loadReservations();
});
