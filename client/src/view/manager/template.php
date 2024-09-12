<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/client/public/css/template_manager.css">
    <title>Role Manager</title>
</head>
<body>
    <div class="side-bar">
        <div class="role-logo" id="role-logo">
            <h3>Role Manager</h3>
        </div>
        <ul class="side-menu">
            <li class="part employees">
                <h4>
                    <p>Employees</p>
                </h4>
                <ul class="submenu items">
                    <li>
                        <a id="all-employees" href="index.php?action=homepage">
                            <i class='bx bx-group'></i>All Employees
                        </a>
                    </li>
                    <li>
                        <a id="create-employee" href="index.php?action=create-employee">
                            <i class='bx bx-user-plus'></i>Create Employee
                        </a>
                    </li>
                </ul>
            </li>
            <li class="request part">
                <h4>
                    <p>Request</p>
                </h4>
                <ul class="submenu items">
                    <li>
                        <a id="leave" href="index.php?action=leave">
                            <i class='bx bx-wifi-off'></i>Leave
                        </a>
                    </li>
                    <li>
                        <a id="update-time" href="index.php?action=update-time">
                            <i class='bx bx-wrench'></i>Update Time
                        </a>
                    </li>
                    <li>
                        <a id="work-from-home" href="index.php?action=work-from-home">
                            <i class='bx bx-home-alt'></i>Work from Home
                        </a>
                    </li>
                </ul>
            </li>
            <li class="events part">
                <h4>
                    <p>Events</p>
                </h4>
                <ul class="submenu items">
                    <li>
                        <a id="all-activities" href="index.php?action=all-activities">
                            <i class='bx bx-sun'></i>All Activities
                        </a>
                    </li>
                    <li>
                        <a id="create-activity" href="index.php?action=create-activity">
                            <i class='bx bx-calendar-plus'></i>Create Activity
                        </a>
                    </li>
                </ul>
            </li>
            <li class="presents part">
                <h4>
                    <p>Presents</p>
                </h4>
                <ul class="submenu items">
                    <li>
                        <a id="all-vouchers" href="index.php?action=all-vouchers">
                            <i class='bx bx-box'></i>All Vouchers
                        </a>
                    </li>
                    <li>
                        <a id="create-voucher" href="index.php?action=create-voucher">
                            <i class='bx bx-list-plus'></i>Create Voucher
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="mail">
                    <a href="#">
                        <i class='bx bx-envelope'></i>
                        <i class='bx bxs-circle'></i>
                    </a>
                </div>
                <div class="notification">
                    <a href="#">
                        <i class='bx bx-bell'></i>
                        <i class='bx bxs-circle'></i>
                    </a>
                </div>
                <button class="user">
                    <i class='bx bx-user-circle'></i>
                    <i class='bx bx-chevron-down'></i>  
                </button>
                <div class="user-menu-content" id="userMenu">
                    <a href="#home"><i class='bx bxs-user-detail'></i>Profile</a>
                    <a href="#about"><i class='bx bx-cog'></i>Setting</a>
                    <a href="#contact"><i class='bx bx-log-out'></i>Log-out</a>
                </div>
            </div>
        </div>
        <main class="content">
            <?php 
                    if (isset($VIEW) && file_exists($VIEW)) {
                        require $VIEW;
                    } else {
                        echo "The view file does not exist.";
                    }
                ?>
        </main>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    // Lấy thông tin từ cookie

    <?php
        echo $curentSidebar;
    ?>

    document.addEventListener('DOMContentLoaded', (event) => {
        const userButton = document.querySelector('.user');
        const userMenu = document.getElementById('userMenu');

        // Toggle dropdown visibility
        userButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent click event from propagating
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Hide dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target) && !userButton.contains(e.target)) {
                userMenu.style.display = 'none';
            }
        });
    });

    const username = getCookie('username');
    const userType = getCookie('user_type');
    const current_tab = "<?php echo $current_tab; ?>";

    // const is_logged_in = username && userType; // Kiểm tra xem người dùng đã đăng nhập hay chưa
    const is_logged_in = true;

    if (!is_logged_in) {
        window.location.href = 'index.php?action=faild';
    } else {
        // Hiển thị dropdown nếu đã đăng nhập
        const dropdown = document.createElement('div');
        dropdown.className = 'dropdown';
        dropdown.innerHTML = `
            <select id="userDropdown" onchange="handleSelectChange()">
                <option value="">${username} (${userType})</option>
                <option value="profile">Profile</option>
                <option value="newPaper">New paper</option>
                <option value="logout">Logout</option>
            </select>
        `;
        document.getElementById("header").appendChild('dropdown');
    }

    if (current_tab == "work-from-home") {
        fetchDataAndPopulateTable('approved', 'approved-table', 'work-from-home');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'work-from-home');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'work-from-home');

    } else if (current_tab == "leave") {
        fetchDataAndPopulateTable('approved', 'approved-table', 'leave');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'leave');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'leave');
    } else if (current_tab == "update-time") {
        fetchDataAndPopulateTable('approved', 'approved-table', 'update-time-sheet');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'update-time-sheet');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'update-time-sheet');
    } else if (current_tab == "all-activities") {
        $("#detail_of_event").hide();
        var myid = '1';

        function list_events() {
            $("#listev").text("");
            $.ajax({
                url: 'http://localhost:5999/call_service',
                type: 'post',
                data: {
                    service_name: 'C_get_all_events'
                },
                dataType: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; i++)
                        $("#listev").append(
                            "<div style='padding-bottom:10'><table>" +
                            "<tr><td>Bắt đầu:</td><td>" + data[i].start + "</td><td>Kết thúc:</td><td>" +
                            data[i].end + "</td></tr>" +
                            "<tr><td>Ngày:</td><td>" + data[i].date + "</td><td>Trạng thái:</td><td>" +
                            data[i].status + "</td></tr>" +
                            "<tr><td><button class='btnxem' value='" + data[i].id +
                            "'>Xem</button></td></tr>" +
                            "</table></div>"
                        );
                }
            });
        }



        $(document).ready(function() {
            list_events();
        });

        $("#btntren").click(function() {
            $("#txtng").focus();
        });

        $("#btntao").click(function() {
            var ng = $("#txtng");
            var bd = $("#txtbd");
            var kt = $("#txtkt");

            if (ng.val() != "" && bd.val() != "" && kt.val() != "")
                $.ajax({
                    url: 'http://localhost:`5999`/call_service',
                    type: 'post',
                    data: {
                        service_name: 'C_create_event',
                        date: ng.val(),
                        start: bd.val(),
                        end: kt.val()
                    },
                    success: function(data) {
                        $("#txtng").val("");
                        $("#txtbd").val("");
                        $("#txtkt").val("");
                        list_events();
                    }
                });
        });



        function list_participants(data, status) {
            var t = $("#listpa");
            t.text("");
            t.append("<table>");
            t.append("<tr><th>Name</th><th>Meter</th><th>Rank</th></tr>");

            for (var i = 0; i < data.length; i++) {
                t.append("<tr>");

                t.append("<td>Name</td>");
                if (status == "Closed")
                    t.append("<td>" + data[i].meter + "</td><td>" + data[i].rank + "</td>");
                else
                    t.append("<td>_ _ _</td><td>_ _</td>");

                t.append("</tr>");
            }
            t.append("</table>");
        }



        $("#listev").on("click", ".btnxem", function() {
            if ($("#list_of_events").is(":visible")) {
                $("#list_of_events").hide();
                $("#detail_of_event").show();
            }
            var eid = $(this).val();
            $("#hid").text(eid);

            $.ajax({
                url: 'http://localhost:5999/call_service',
                type: 'post',
                data: {
                    service_name: 'C_get_detail_event',
                    eid: eid,
                    myid: myid
                },
                dataType: 'json',
                success: function(data) {
                    status = data[0].status;
                    exist = data[2].exist;

                    $("#tdng").text(data[0].date);
                    $("#tdbd").text(data[0].start);
                    $("#tdkt").text(data[0].end);
                    $("#tdtt").text(status);

                    list_participants(data[1], status);

                    flag = (status == "Closed" || exist == "true") ? false : true;
                    if (flag == false) $("#btnthamgia").prop("disabled", true);
                    else $("#btnthamgia").prop("disabled", false);
                }
            });
        });



        $("#btnthamgia").click(function() {
            $.ajax({
                url: 'http://localhost:5999/call_service',
                type: 'post',
                data: {
                    service_name: 'C_add_participant',
                    eid: $("#hid").text(),
                    myid: myid
                },
                dataType: 'json',
                success: function(data) {
                    list_participants(data, '');
                    $("#btnthamgia").prop("disabled", true);
                }
            });
        });



        $("#btnquaylai").click(function() {
            $("#detail_of_event").hide();
            $("#list_of_events").show();
        });


    } else if (current_tab == "all-vouchers") {

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

    function deleteCookie(name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    }

    function handleSelectChange() {
        const selectedOption = document.getElementById('userDropdown').value;
        if (selectedOption === 'profile') {
            window.location.href = 'index.php?action=profile';
        } else if (selectedOption === 'newPaper') {
            window.location.href = 'index.php?action=new-paper';
        } else if (selectedOption === 'logout') {
            deleteCookie("user_id");
            deleteCookie("user_type");
            deleteCookie("username");
            deleteCookie("authToken");
            deleteCookie("user_id");

            window.location.href = 'index.php?action=login';
        }
    }

    function fetchDataAndPopulateTable(status, tableId, endpoint) {
        fetch(`http://127.0.0.1:5500/api/requests-service/manager/requests/${endpoint}?status=${status}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById(tableId).querySelector('tbody');
                tableBody.innerHTML = ''; // Clear existing table content
                console.log(data);

                data.forEach((item, index) => {
                    const row = document.createElement('tr');

                    // Add STT (index + 1)
                    const sttCell = document.createElement('td');
                    sttCell.textContent = index + 1;
                    row.appendChild(sttCell);

                    // Add User ID
                    const userIdCell = document.createElement('td');
                    userIdCell.textContent = item[1]; // USER_ID
                    row.appendChild(userIdCell);

                    // Add Title
                    const titleCell = document.createElement('td');
                    titleCell.textContent = item[3]; // TITLE
                    row.appendChild(titleCell);

                    // Add Start Date
                    const startDateCell = document.createElement('td');
                    startDateCell.textContent = new Date(item[6]).toLocaleString(); // START_DATE
                    row.appendChild(startDateCell);

                    // Add End Date
                    const endDateCell = document.createElement('td');
                    endDateCell.textContent = new Date(item[7]).toLocaleString(); // END_DATE
                    row.appendChild(endDateCell);

                    // Add Feature Column
                    if (status === 'waiting') {
                        const featureCell = document.createElement('td');

                        // Create Approved Button
                        const approvedButton = document.createElement('button');
                        approvedButton.textContent = 'Approve';
                        approvedButton.addEventListener('click', () => handleConclusion(item[0],
                            'approved')); // item[0] is REQUEST_ID
                        featureCell.appendChild(approvedButton);

                        // Create Reject Button
                        const rejectButton = document.createElement('button');
                        rejectButton.textContent = 'Reject';
                        rejectButton.addEventListener('click', () => handleConclusion(item[0],
                        'rejected')); // item[0] is REQUEST_ID
                        featureCell.appendChild(rejectButton);

                        row.appendChild(featureCell);
                    }

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Handle Conclusion (Approve or Reject)
    function handleConclusion(requestId, conclusionStatus) {
        fetch('http://127.0.0.1:5500/api/requests-service/manager/request/conclusion', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'id': requestId,
                    'handler': 1, // You can replace this with the actual handler ID if needed
                    'status': conclusionStatus
                })
            })
            .then(response => {
                if (response.ok) {
                    console.log(`Request ${conclusionStatus} successfully`);
                    // Optionally, refresh the table or update the UI
                    fetchDataAndPopulateTable('waiting', 'waiting-table', 'work-from-home');
                } else {
                    console.error('Failed to conclude request');
                }
            })
            .catch(error => console.error('Error concluding request:', error));
    }

    document.querySelector('.user').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the event from bubbling up to the window
        var userMenu = document.getElementById('userMenu');
        userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
    }); 

    </script>
</body>
<script>

    let topScreen = 0;
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        const content = document.querySelector('.content')
        let currScreen = window.pageYOffset || document.documentElement.scrollTop
        if (currScreen > topScreen) {
            header.style.top = '-9vh';
        } else {
            header.style.top = '0px';
        }
    });
</script>
</html>