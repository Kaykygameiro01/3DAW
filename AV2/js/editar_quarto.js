document.addEventListener('DOMContentLoaded', () => {
  // Obter o ID do quarto da URL
  const urlParams = new URLSearchParams(window.location.search);
  const roomId = urlParams.get('id');

  // Verificar se o ID é válido
  if (!roomId || isNaN(roomId)) {
    console.error('ID do quarto inválido ou não encontrado na URL.');
    alert('Erro: ID do quarto inválido.');
    window.location.href = 'admin.html'; // Redireciona para a página inicial
    return;
  }

  console.log('ID do quarto obtido:', roomId);

  // Carregar os dados do quarto
  fetch(`php/obter_quarto.php?id=${roomId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error(
          `Erro ao buscar dados do quarto: ${response.statusText}`,
        );
      }
      return response.json();
    })
    .then((data) => {
      if (data && data.id) {
        // Preencher os campos do formulário com os dados do quarto
        document.getElementById('room-id').value = data.id;
        document.getElementById('type').value = data.type;
        document.getElementById('description').value = data.description;
        document.getElementById('price').value = data.price;
        document.getElementById('status').value = data.status;
        document.getElementById('image_url').value = data.image_url;
        console.log('Dados do quarto carregados com sucesso:', data);
      } else {
        throw new Error('Os dados do quarto não foram encontrados.');
      }
    })
    .catch((error) => {
      console.error('Erro ao carregar dados do quarto:', error);
      alert('Erro ao carregar os dados do quarto.');
      window.location.href = 'admin.html'; // Redireciona para a página inicial
    });

  // Enviar as alterações para o backend
  document.getElementById('edit-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    // Log para depuração
    console.log('Dados enviados para o backend:');
    for (let [key, value] of formData.entries()) {
      console.log(`${key}: ${value}`);
    }

    fetch('php/editar_quarto.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Erro ao atualizar quarto: ${response.statusText}`);
        }
        return response.json();
      })
      .then((data) => {
        if (data.message) {
          alert(data.message);
          window.location.href = 'admin.html'; // Redireciona para a página inicial
        } else if (data.error) {
          throw new Error(data.error);
        }
      })
      .catch((error) => {
        console.error('Erro ao atualizar o quarto:', error);
        alert('Erro ao salvar as alterações do quarto.');
      });
  });
});
