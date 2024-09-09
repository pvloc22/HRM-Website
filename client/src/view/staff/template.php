<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/template_client.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>
    <div id="container">
        <header>
            <div class="header-left">
                <a href="index.php">Home</a>
                <a href="#">Topics</a>
                <a href="#">Authors</a>
                <a href="#">Contact</a>
            </div>
            <div class="header-right">
                <div class="user-options">
                    <!-- User options can be added here -->
                </div>
            </div>
        </header>
        <main>
            <h1>Request Work From Home</h1>
            <form id="wfh-form">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required><br><br>
                
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" required><br><br>
                
                <label for="id_card_number">ID Card Number:</label>
                <input type="text" id="id_card_number" name="id_card_number" required><br><br>
                
                <label for="title">Request Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                
                <label for="content">Request Content:</label>
                <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
                
                <label for="type_request">Request Type:</label>
                <select id="type_request" name="type_request" required>
                    <option value="WFH">Work From Home</option>
                    <option value="LEAVE">Leave</option>
                    <option value="UTS">Work From Home</option>

                    <!-- Add other types of requests here if needed -->
                </select><br><br>
                
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required><br><br>
                
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required><br><br>
                
                <button type="button" onclick="submitRequest()">Submit Request</button>
            </form>
        </main>
        <footer>
            <p>&copy; 2024 Your Company Name. All Rights Reserved.</p>
        </footer>
    </div>
    <script>
        async function submitRequest() {
            const form = document.getElementById('wfh-form');
            const formData = new FormData(form);
            
            try {
                const response = await fetch('http://127.0.0.1:5500/api/requests-service/user/request', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                console.log('Success:', result);
                alert('Request submitted successfully');
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to submit request');
            }
        }
    </script>
</body>

</html>
