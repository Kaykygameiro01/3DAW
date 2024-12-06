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
          // Exibe mensagem de erro
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
