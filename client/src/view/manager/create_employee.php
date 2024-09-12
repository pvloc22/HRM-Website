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
                        <input type="text" placeholder="Enter Full Name" required>
                        <div class="underline"></div>
                    </div>
                    <div id="age" class="input-data">
                        <div class="label">Age <span style="color:red">*</span></div>
                        <input type="number" placeholder="Enter Age" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="phone" class="input-data">
                        <div class="label">Phone Number <span style="color:red">*</span></div>
                        <input type="number" placeholder="Enter Phone Number" required>
                        <div class="underline"></div>
                    </div>
                    <div id="email" class="input-data">
                        <div class="label">Email <span style="color:red">*</span></div>
                        <input type="email" placeholder="Enter Email" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="address" class="input-data">
                        <div class="label">Address <span style="color:red">*</span></div>
                        <input type="text" placeholder="Enter Address" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="bankname" class="input-data">
                        <div class="label">Bank Name <span style="color:red">*</span></div>
                        <input type="text" placeholder="Enter Bank Name" required>
                        <div class="underline"></div>
                    </div>
                    <div id="banknumber" class="input-data">
                        <div class="label">Bank Account Number <span style="color:red">*</span></div>
                        <input type="number" placeholder="Enter Bank Account Number" required>
                        <div class="underline"></div>
                    </div>
                    
                </div>
                <div class="form-row">
                <div id="idcard" class="input-data">
                        <div class="label">Id Card <span style="color:red">*</span></div>
                        <input type="number" placeholder="Enter ID Card" required>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row form-btns">
                    <a href="index.php?action=homepage" class="btn cancel-btn" href="">Cancel</a>
                    <a class="btn update-btn" href=""><i class='bx bx-plus'></i>Add Employee</a>
                </div>
            </form>
    </div>
</body>
</html>