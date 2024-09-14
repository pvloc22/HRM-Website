<link rel="stylesheet" href="/client/public/css/view_request.css">
<div class="wrapper">
    <form action="#">
        <div class="form-row">
            <div class="emp">
                <div class="mini-avatar">
                    <img src="https://picsum.photos/id/1011/500/500" class="avatar__image">
                </div>
                <div class="name_email">
                    <div>Phạm Hữu Lộc</div>
                    <div>phlexample@gmail.com</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div id="fullname" class="input-data">
                <div class="label">Employee Name <span style="color:red">*</span></div>
                <input type="text" value="Phạm Hữu Lộc" required>

            </div>
            <div id="age" class="input-data">
                <div class="label">Employee ID <span style="color:red">*</span></div>
                <input type="number" value="26" required>

            </div>
        </div>
        <div class="form-row">
            <div id="phone" class="input-data">
                <div class="label">Phone Number <span style="color:red">*</span></div>
                <input type="number" value="09875432112" required>

            </div>
            <div id="email" class="input-data">
                <div class="label">Email <span style="color:red">*</span></div>
                <input type="email" value="exampl@gmail.com" required>

            </div>
        </div>
        <div class="form-row">
            <div id="title" class="input-data">
                <div class="label">Title <span style="color:red">*</span></div>
                <input type="text" value="Trường Đại học KHTN Lorem Ipsum is simply dummy " required>

            </div>
        </div>
        <div class="form-row">
            <div id="reason" class="input-data">
                <div class="label">Reason <span style="color:red">*</span></div>
                <textarea name="" id=""  rows="4" cols="100">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </textarea>
            </div>
        </div>
        <div class="form-row">
            <div id="bankname" class="input-data">
                <div class="label">Start Date <span style="color:red">*</span></div>
                <input type="date" value="BIDV" required>

            </div>
            <div id="banknumber" class="input-data">
                <div class="label">End Date <span style="color:red">*</span></div>
                <input type="date" value="012345678909" required>

            </div>

        </div>
        <div class="form-row form-btns">
            <a href="index.php?action=work-from-home" class="btn cancel-btn" href="">Cancel</a>
            <a class="btn reject-btn" href="">Reject</a>
            <a class="btn confirm-btn" href="">Confirm</a>
        </div>
    </form>
</div>