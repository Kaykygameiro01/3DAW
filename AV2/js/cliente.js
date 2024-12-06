document.addEventListener('DOMContentLoaded', () => {
  loadAvailableRooms();

  function loadAvailableRooms() {
    fetch('php/quartos.php')
      .then((response) => response.json())
      .then((data) => {
        const roomSection = document.getElementById('available-rooms');
        roomSection.innerHTML = '<h2>Quartos Disponíveis</h2>';

        const availableRooms = data.filter(
          (room) => room.status === 'available',
        );

        if (availableRooms.length === 0) {
          roomSection.innerHTML +=
            '<p>Não há quartos disponíveis no momento.</p>';
        } else {
          availableRooms.forEach((room) => {
            const roomElement = document.createElement('div');
            roomElement.classList.add('room');
            roomElement.innerHTML = `
              <p><strong>Tipo:</strong> ${room.type}</p>
              <p><strong>Descrição:</strong> ${room.description}</p>
              <p><strong>Preço:</strong> R$ ${room.price}</p>
              <button onclick="reserveRoom(${room.id})">Reservar</button>
            `;
            roomSection.appendChild(roomElement);
          });
        }
      })
      .catch((error) => {
        console.error('Erro ao carregar quartos:', error);
        document.getElementById('available-rooms').innerHTML =
          '<p>Erro ao carregar os quartos. Tente novamente mais tarde.</p>';
      });
  }
});

// Função para reservar o quarto
function reserveRoom(roomId) {
  const confirmReservation = confirm(
    'Você deseja confirmar a reserva deste quarto?',
  );

  if (confirmReservation) {
    fetch(`php/reservar_quarto.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: roomId }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert('Reserva confirmada com sucesso!');
          window.location.reload(); // Recarrega a página para atualizar a lista
        } else {
          alert('Erro ao confirmar a reserva. Tente novamente.');
        }
      })
      .catch((error) => {
        console.error('Erro ao confirmar a reserva:', error);
        alert(
          'Erro ao confirmar a reserva. Verifique o console para mais detalhes.',
        );
      });
  }
}
