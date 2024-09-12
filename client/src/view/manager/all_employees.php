<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/client/public/css/all_employees.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="wrapper-header">
            <div class="browse">
                <span class="search-icon"><i class='bx bx-search'></i></span>
                <input type="search" class="search-bar" placeholder="Search...">
            </div>
            <div class="empty-block"></div>
            <div class="filter">
                <select class="custom-select" id="sorted" style="width: 100px;">
                    <option value="0" selected>Default</option>
                    <option value="1">Dec</option>
                    <option value="2">A &#8594; Z</option> <!-- Used arrow character for the icon -->
                    <option value="3">Z &#8594; A</option>
                </select>
            </div>
        </div>
        <div class="wrapper-main">
            <table>
                <thead>
                    <tr>
                        <td class="tb-stt">STT</td>
                        <td class="tb-name">Họ và tên</td>
                        <td class="tb-email">Email</td>
                        <td class="tb-phone">Phone numbers</td>
                        <td class="tb-cccd">CMND/CCCD</td>
                        <td class="tb-actions">Features</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tb-stt">1</td>
                        <td class="tb-name">Phạm Hữu Lộc</td>
                        <td class="tb-email">example@gmal.com</td>
                        <td class="tb-phone">0987654321123</td>
                        <td class="tb-cccd">0123456789</td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=1" class="ishow"><i class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=1" class="iedit"><i class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tb-stt">2</td>
                        <td class="tb-name">Phạm Hữu Lộc</td>
                        <td class="tb-email">example@gmal.com</td>
                        <td class="tb-phone">0987654321123</td>
                        <td class="tb-cccd">0123456789</td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=2" class="ishow"><i class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=2" class="iedit"><i class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tb-stt">3</td>
                        <td class="tb-name">Phạm Hữu Lộc</td>
                        <td class="tb-email">example@gmal.com</td>
                        <td class="tb-phone">0987654321123</td>
                        <td class="tb-cccd">0123456789</td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=3" class="ishow"><i class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=3" class="iedit"><i class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tb-stt">4</td>
                        <td class="tb-name">Phạm Hữu Lộc</td>
                        <td class="tb-email">example@gmal.com</td>
                        <td class="tb-phone">0987654321123</td>
                        <td class="tb-cccd">0123456789</td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=4" class="ishow"><i class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=4" class="iedit"><i class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tb-stt">5</td>
                        <td class="tb-name">Phạm Hữu Lộc</td>
                        <td class="tb-email">example@gmal.com</td>
                        <td class="tb-phone">0987654321123</td>
                        <td class="tb-cccd">0123456789</td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=5" class="ishow"><i class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=5" class="iedit"><i class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="wrapper-footer">
            <div id="pagination" class="pagination"></div>
        </div>
    </div>
    <script>
        let pages = 25;
        let start_page = 1;
        document.getElementById('pagination').innerHTML = createPagination(pages, start_page);

        function createPagination(pages, page) {
            let str = '<ul>';
            let active;
            let pageCutLow = page - 1;
            let pageCutHigh = page + 1;

            if (page > 1) {
                str += '<li class="page-item previous no"><a onclick="createPagination(pages, '+(page-1)+')"><i class="bx bx-chevron-left"></i></a></li>';
            }
            if (pages < 6) {
                for (let p = 1; p <= pages; p++) {
                active = page == p ? "active" : "no";
                str += '<li class="'+active+'"><a onclick="createPagination(pages, '+p+')">'+ p +'</a></li>';
                }
            } else {
                if (page > 2) {
                    str += '<li class="no page-item"><a onclick="createPagination(pages, 1)">1</a></li>'
                    if (page > 3) {
                        str += '<li class="out-of-range"><a onclick="createPagination(pages, '+(page-2)+')">...</a></li>'
                    }
                }
                if (page === 1) {
                    pageCutHigh += 2;
                } else if (page === 2) {
                    pageCutHigh += 1;
                }
                if (page === pages) {
                    pageCutLow -= 2;
                } else if (page === pages-1) {
                    pageCutLow -= 1;
                }
                for (let p = pageCutLow; p < pageCutHigh; p++) {
                    if (p === 0) {
                        p+=1;
                    }
                    if(p>pages){
                        continue;
                    }
                    active = page == p ? "active" : "no";
                    str += '<li class="page-item '+active+'"><a onclick="createPagination(pages, '+p+')">'+ p +'</a></li>'
                }
                if (page < pages-1) {
                    if (page < pages-2) {
                        str += '<li class="out-of-range"><a onclick="createPagination(pages,'+(page+2)+')">...</a></li>';
                    }
                    str += '<li class="page-item no"><a onclick="createPagination(pages, pages)">'+pages+'</a></li>';
                }
            }
            if (page < pages) {
                str += '<li class="page-item next no"><a onclick="createPagination(pages, '+(page+1)+')"><i class="bx bx-chevron-right"></i></a></li>';
            }
            str += '</ul>';
            // Return the pagination string to be outputted in the pug templates
            document.getElementById('pagination').innerHTML = str;
            return str;
        }
    </script>
</body>

</html>