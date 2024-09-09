<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Manager</title>
    <link rel="stylesheet" href="/public/css/template_manager.css">
</head>
<body>
    <div class="container">
        <header>
            <div id="header">

            </div>
            <!-- end header -->
        </header>

        <nav class="sidebar">
            <div id="role_logo">
                <h2>Role Manager</h2>
            </div>
            <ul>
                <li class="part">
                    <a href="#employees">Employees</a>
                    <ul class="submenu">
                        <li><a id="all-employees" href="index.php?action=homepage">All Employees</a></li>
                        <li><a id="create-employee" href="index.php?action=create-employee">Create Employee</a></li>
                    </ul>
                </li>
                <li class="part">
                    <a href="#request">Request</a>
                    <ul class="submenu">
                        <li><a id="leave" href="index.php?action=leave">Leave</a></li>
                        <li><a id="update-time" href="index.php?action=update-time">Update Time</a></li>
                        <li><a id="work-from-home" href="index.php?action=work-from-home">Work from Home</a></li>
                    </ul>
                </li>
                <li class="part">
                    <a href="#events">Events</a>
                    <ul class="submenu">
                        <li><a id="all-activities" href="index.php?action=all-activities">All Activities</a></li>
                        <li><a id="create-activity" href="index.php?action=create-activity">Create Activity</a></li>
                    </ul>
                </li>
                <li class="part">
                    <a href="#presents">Presents</a>
                    <ul class="submenu">
                        <li><a id="all-vouchers" href="index.php?action=all-vouchers">All Vouchers</a></li>
                        <li><a id="create-voucher" href="index.php?action=create-voucher">Create Voucher</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main class="content">
        <?php 
            echo require_once($VIEW);
        ?>
        </main>
        <footer>
            <h1>Footer</h1>
        </footer>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    // Lấy thông tin từ cookie

    <?php
        echo $curentSidebar
    ?>

    const username = getCookie('username');
    const userType = getCookie('user_type');
    const current_tab = "<?php echo $current_tab ?>";
    
    const is_logged_in = username && userType;  // Kiểm tra xem người dùng đã đăng nhập hay chưa

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
        document.getElementById("header").appendChild(dropdown);
    }

    if(current_tab == "work-from-home")
    {
        fetchDataAndPopulateTable('approved', 'approved-table', 'work-from-home');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'work-from-home');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'work-from-home');

    }
    else if(current_tab == "leave")
    {
        fetchDataAndPopulateTable('approved', 'approved-table', 'leave');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'leave');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'leave');
    }
    else if(current_tab == "update-time")
    {
        fetchDataAndPopulateTable('approved', 'approved-table', 'update-time-sheet');
        fetchDataAndPopulateTable('rejected', 'refused-table', 'update-time-sheet');
        fetchDataAndPopulateTable('waiting', 'waiting-table', 'update-time-sheet');
    }
    else if(current_tab == "all-activities")
    {
        $("#detail_of_event").hide();
        var myid = '1';



        function list_events(){
            $("#listev").text("");
            $.ajax({
            url: 'http://localhost:5999/call_service',
            type: 'post',
            data: { service_name: 'C_get_all_events' },
            dataType: 'json',
            success: function(data){
            for (var i = 0; i < data.length; i++)
                $("#listev").append(
                "<div style='padding-bottom:10'><table>"
                + "<tr><td>Bắt đầu:</td><td>" + data[i].start + "</td><td>Kết thúc:</td><td>" + data[i].end + "</td></tr>"
                + "<tr><td>Ngày:</td><td>" + data[i].date + "</td><td>Trạng thái:</td><td>" + data[i].status + "</td></tr>"
                + "<tr><td><button class='btnxem' value='" + data[i].id + "'>Xem</button></td></tr>"
                + "</table></div>"		
                );
            }
            });
        }



        $(document).ready(function(){
            list_events();
        });



        $("#btntren").click(function(){
            $("#txtng").focus();
        });



        $("#btntao").click(function(){
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
            success: function(data){
                $("#txtng").val("");
                $("#txtbd").val("");
                $("#txtkt").val("");
                list_events();
            }
            });
        });



        function list_participants(data, status){
            var t = $("#listpa");
            t.text("");
            t.append("<table>"); 
            t.append("<tr><th>Name</th><th>Meter</th><th>Rank</th></tr>"); 

            for (var i = 0 ; i < data.length; i++) {
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



        $("#listev").on("click", ".btnxem", function(){
            if ($("#list_of_events").is(":visible")){
                $("#list_of_events").hide();
                $("#detail_of_event").show();
            }
            var eid = $(this).val();
            $("#hid").text(eid);

            $.ajax({
            url: 'http://localhost:5999/call_service',
            type: 'post',
            data: { 	service_name: 'C_get_detail_event',
                    eid: eid,
                    myid: myid },
            dataType: 'json',
            success: function(data){
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



        $("#btnthamgia").click(function(){
            $.ajax({
            url: 'http://localhost:5999/call_service',
            type: 'post',
            data: { 
                service_name: 'C_add_participant',
                eid: $("#hid").text(),
                myid: myid },
            dataType: 'json',
            success: function(data){
                list_participants(data, '');
                $("#btnthamgia").prop("disabled", true);
            }
            });
        });



        $("#btnquaylai").click(function(){
            $("#detail_of_event").hide();
            $("#list_of_events").show();
        });


    }
    else if(current_tab == "all-vouchers")
    {

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
                    approvedButton.addEventListener('click', () => handleConclusion(item[0], 'approved')); // item[0] is REQUEST_ID
                    featureCell.appendChild(approvedButton);

                    // Create Reject Button
                    const rejectButton = document.createElement('button');
                    rejectButton.textContent = 'Reject';
                    rejectButton.addEventListener('click', () => handleConclusion(item[0], 'rejected')); // item[0] is REQUEST_ID
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

    </script>
</body>
</html>
