document.addEventListener('DOMContentLoaded', () => {
  fetch('php/rooms.php')
    .then((response) => response.json())
    .then((data) => {
      const roomsContainer = document.getElementById('rooms');
      roomsContainer.innerHTML = ''; // Limpar conteúdo inicial

      data.forEach((room) => {
        const roomElement = document.createElement('div');
        roomElement.classList.add('room');
        roomElement.innerHTML = `
                  <img src="${room.image_url}" alt="Quarto com ${
          room.type
        } vagas" class="room-image">
                  <h3>Quarto com ${room.type} vagas</h3>
                  <p>${room.description}</p>
                  <p>Status: ${
                    room.status === 'available' ? 'Disponível' : 'Ocupado'
                  }</p>
                  <button ${
                    room.status !== 'available' ? 'disabled' : ''
                  } onclick="reserveRoom(${room.id})">
                      Reservar agora
                  </button>
              `;
        roomsContainer.appendChild(roomElement);
      });
    })
    .catch((error) => console.error('Erro ao carregar os quartos:', error));
});

function reserveRoom(roomId) {
  window.location.href = `reserva.html?room_id=${roomId}`;
}
