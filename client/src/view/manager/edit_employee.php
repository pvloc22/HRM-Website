<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/client/public/css/edit_employee.css">
    <title>Edit Employee</title>
</head>
<body>
    <div class="wrapper">
            <form action="#">
                <div class="form-row">
                    <div id="fullname" class="input-data">
                        <div class="label">Full Name <span style="color:red">*</span></div>
                        <input type="text" value="Phạm Hữu Lộc" required>
                        <div class="underline"></div>
                    </div>
                    <div id="age" class="input-data">
                        <div class="label">Age <span style="color:red">*</span></div>
                        <input type="number" value="26" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="phone" class="input-data">
                        <div class="label">Phone Number <span style="color:red">*</span></div>
                        <input type="number" value="09875432112" required>
                        <div class="underline"></div>
                    </div>
                    <div id="email" class="input-data">
                        <div class="label">Email <span style="color:red">*</span></div>
                        <input type="email" value="exampl@gmail.com" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="address" class="input-data">
                        <div class="label">Address <span style="color:red">*</span></div>
                        <input type="text" value="Trường Đại học KHTN" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="bankname" class="input-data">
                        <div class="label">Bank Name <span style="color:red">*</span></div>
                        <input type="text" value="BIDV" required>
                        <div class="underline"></div>
                    </div>
                    <div id="banknumber" class="input-data">
                        <div class="label">Bank Account Number <span style="color:red">*</span></div>
                        <input type="number" value="012345678909" required>
                        <div class="underline"></div>
                    </div>
                    
                </div>
                <div class="form-row">
                <div id="idcard" class="input-data">
                        <div class="label">Id Card <span style="color:red">*</span></div>
                        <input type="number" value="09876567890" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row form-btns">
                    <a href="index.php?action=homepage" class="btn cancel-btn" href="">Cancel</a>
                    <a class="btn update-btn" href="">Update</a>
                </div>
            </form>
    </div>
</body>
</html>