document.addEventListener('DOMContentLoaded', () => {
  loadRooms(); // Carregar os quartos assim que a página for carregada

  // Função para carregar os quartos cadastrados
  function loadRooms() {
    fetch('php/quartos.php')
      .then((response) => response.json()) // Receber o JSON do PHP
      .then((data) => {
        const roomList = document.getElementById('room-list');
        roomList.innerHTML = '<h2>Quartos Cadastrados</h2>';

        // Verifique se a resposta contém quartos
        if (data.length === 0) {
          roomList.innerHTML += '<p>Não há quartos cadastrados.</p>';
        } else {
          // Para cada quarto retornado, crie um novo elemento na lista
          data.forEach((room) => {
            const roomElement = document.createElement('div');
            roomElement.classList.add('room');
            roomElement.innerHTML = `
                          <p><strong>Tipo:</strong> ${room.type}</p>
                          <p><strong>Descrição:</strong> ${room.description}</p>
                          <p><strong>Preço:</strong> R$ ${room.price}</p>
                          <p><strong>Status:</strong> ${room.status}</p>
                          <p><strong>Imagem:</strong> ${
                            room.image_url || 'Sem imagem'
                          }</p>
                          <button onclick="editRoom(${room.id})">Editar</button>
                          <button onclick="deleteRoom(${
                            room.id
                          })">Excluir</button>
                      `;
            roomList.appendChild(roomElement);
          });
        }
      })
      .catch((error) => {
        console.error('Erro ao carregar os quartos:', error);
        const roomList = document.getElementById('room-list');
        roomList.innerHTML =
          '<p>Erro ao carregar os quartos. Verifique o console para mais detalhes.</p>';
      });
  }

  // Função para exibir o formulário de adição de quarto
  document.getElementById('add-room-button').addEventListener('click', () => {
    document.getElementById('add-room-form').style.display = 'block'; // Exibe o formulário
  });

  // Adiciona um novo quarto ao banco
  document.getElementById('new-room-form').addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    fetch('php/adicionar_quarto.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert('Quarto adicionado com sucesso!');
        loadRooms(); // Recarregar a lista de quartos
        document.getElementById('add-room-form').style.display = 'none'; // Esconder o formulário
      })
      .catch((error) => {
        console.error('Erro ao adicionar o quarto:', error);
        alert(
          'Erro ao adicionar o quarto. Verifique o console para mais detalhes.',
        );
      });
  });
});

// Função para editar um quarto (por enquanto, apenas um alerta)
function editRoom(roomId) {
  alert(`Editar quarto ID: ${roomId}`);
}

// Função para excluir um quarto
function deleteRoom(roomId) {
  if (confirm('Tem certeza que deseja excluir este quarto?')) {
    fetch(`php/deletar_quarto.php?id=${roomId}`, {
      method: 'DELETE',
    })
      .then((response) => response.json())
      .then((data) => {
        alert('Quarto excluído com sucesso!');
        loadRooms(); // Recarregar a lista de quartos
      })
      .catch((error) => console.error('Erro ao excluir o quarto:', error));
  }
}
// Função para editar um quarto
function editRoom(roomId) {
  window.location.href = `editar_quarto.html?id=${roomId}`; // Redirecionar para a página de edição com o ID do quarto
}
