<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>

<body>
    <div class="login-form">
        <div style="overflow-x: auto; width: 300px;">
            <img src="logo.jpeg" alt="Login" style="width: 130px; height: 130px;">
        </div>

        <form onsubmit="return login(event)">
            <div class="text">Login</div>

            <div class="field">
                <div class="fas fa-envelope"></div>
                <input type="text" id="usuario" placeholder="Usuário" required>
            </div>

            <div class="field password-field">
                <div class="fas fa-lock"></div>
                <input type="password" id="senha" placeholder="Senha" required>
            </div>

            <button type="submit">LOGIN</button>
        </form>
    </div>

    <script>
        // Alternar visibilidade da senha
        const togglePassword = document.getElementById('togglePassword');
        const senhaInput = document.getElementById('senha');

        togglePassword.addEventListener('click', function () {
            const type = senhaInput.type === 'password' ? 'text' : 'password';
            senhaInput.type = type;
            this.classList.toggle('fa-eye-slash');
        });

        // Função de login
        async function login(event) {
            event.preventDefault();

            const usuario = document.getElementById('usuario').value;
            const senha = document.getElementById('senha').value;

            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ usuario, senha })
                });

                const data = await response.json();

                if (response.ok && data.token) {
                    localStorage.setItem('token', data.token);
                    window.location.href = '../Matricula/index.php';
                } else {
                    alert(data.erro || 'Erro desconhecido.');

                    // Se o backend mandar resetar os campos
                    if (data.resetar_campos) {
                        document.getElementById('usuario').value = '';
                        document.getElementById('senha').value = '';
                    } else {
                        document.getElementById('senha').value = '';
                    }

                    document.getElementById('usuario').focus();
                }

            } catch (error) {
                alert('Erro de conexão com o servidor.');
            }
        }
    </script>
</body>
</html>
