
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/welcome_faild.css">
</head>
<body>
    <div class="center">
        <h1 id="welcome"></h1>
        <p>This is your personalized welcome page.</p>
        <a href="../../index.php?action=homepage">Home Page</a> <!-- Đường dẫn đến trang logout -->
    </div>
    <script>
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
        var welcome = document.getElementById("welcome");
        const username = getCookie('username');
        welcome.textContent = "Welcome, " +username;
    </script>
</body>
</html>