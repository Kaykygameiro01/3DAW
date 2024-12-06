document.addEventListener('DOMContentLoaded', () => {
  fetch('php/quartos.php')
    .then((response) => response.json())
    .then((data) => {
      const roomsContainer = document.getElementById('rooms');
      roomsContainer.innerHTML = '';

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
  window.location.href = `formulario_reserva.html?id=${roomId}`;
}
// Abrir o modal de login
function openLogin() {
  document.getElementById('login-modal').style.display = 'flex';
}

// Fechar o modal de login
function closeLogin() {
  document.getElementById('login-modal').style.display = 'none';
}

// Lógica de envio do formulário de login
document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('login-form');
  const loginError = document.getElementById('login-error');

  loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(loginForm);

    fetch('php/validar_login.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Redireciona conforme o tipo de usuário
          window.location.href = data.redirect;
        } else {
          loginError.textContent = data.message;
          loginError.style.display = 'block';
        }
      })
      .catch((error) => {
        console.error('Erro ao realizar o login:', error);
        loginError.textContent = 'Erro ao processar o login. Tente novamente.';
        loginError.style.display = 'block';
      });
  });
});
