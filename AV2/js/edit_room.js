document.addEventListener('DOMContentLoaded', () => {
  // Obter o ID do quarto da URL
  const urlParams = new URLSearchParams(window.location.search);
  const roomId = urlParams.get('id');

  // Carregar os dados do quarto
  fetch(`php/get_room.php?id=${roomId}`)
    .then((response) => response.json())
    .then((data) => {
      if (data) {
        // Preencher os campos do formulário com os dados do quarto
        document.getElementById('room-id').value = data.id;
        document.getElementById('type').value = data.type;
        document.getElementById('description').value = data.description;
        document.getElementById('price').value = data.price;
        document.getElementById('status').value = data.status;
        document.getElementById('image_url').value = data.image_url;
      }
    })
    .catch((error) =>
      console.error('Erro ao carregar dados do quarto:', error),
    );

  // Enviar as alterações para o backend
  document.getElementById('edit-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    fetch('php/edit_room.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert('Quarto atualizado com sucesso!');
        window.location.href = 'admin.html'; // Redirecionar de volta para a administração
      })
      .catch((error) => {
        console.error('Erro ao atualizar o quarto:', error);
        alert(
          'Erro ao atualizar o quarto. Verifique o console para mais detalhes.',
        );
      });
  });
});
