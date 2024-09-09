<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form id="loginForm">
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="email" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Đăng nhập</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1);
                if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
            return null;
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            fetch('http://127.0.0.1:5500/api/auth-service/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username: username, password: password })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('message').textContent = 'Đăng nhập thành công!';
                // add data to cookie
                setCookie('authToken', data.access_token, 7);
                setCookie('username', data.username, 7);
                setCookie('user_id', data.user_id, 7);
                setCookie('user_type', data.role, 7);
                
                if(data.role == "employee")
                    window.location.href = 'index.php?action=client';
                else
                    window.location.href = 'view/shared/welcome.php';

            })
            .catch((error) => {
                document.getElementById('message').textContent = 'Đăng nhập thất bại. Vui lòng thử lại!';
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>