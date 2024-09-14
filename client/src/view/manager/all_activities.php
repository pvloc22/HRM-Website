<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/client/public/css/all_activities.css">
    <title>All Activities</title>
</head>

<body>
    <?php
    $is_login = true; 
    if (!$is_login) {
        // Nếu chưa đăng nhập
        echo '<div class="auth-container">
                  <button class="auth-button" onclick="window.location.href=\'login.php\'">Authentication</button>
              </div>';
    } else {
        // Nếu đã đăng nhập
        ?>
    <div class="wrapper">
        <div class="wrapper-header">
            <div class="label">All Activities</div>
            <div class="browse">
                <span class="search-icon"><i class='bx bx-search'></i></span>
                <input type="search" class="search-bar" placeholder="Search...">
            </div>
        </div>
        <div class="wrapper-main">
            <table>
                <thead>
                    <tr>
                        <td class="tb-stt">STT</td>
                        <td class="tb-titl">Title</td>
                        <td class="tb-desc">Description</td>
                        <td class="tb-duration">Duration</td>
                        
                        <td class="tb-actions">Features</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tb-stt">1</td>
                        <td class="tb-titl">Phạm Hữu Lộc</td>
                        <td class="tb-desc">Lorem ipsum</td>
                        <td class="tb-dur">
                            <div>
                                <div class="capsule">1/8/2024</div>
                                <div class="capsule-no">10/8/2024</div>
                            </div>
                        </td>
                        <td class="tb-actions">
                            <div class="actions">
                                <a href="index.php?action=view-employee&id=1" class="ishow"><i
                                        class='bx bx-show'></i></a>
                                <a href="index.php?action=edit-employee&id=1" class="iedit"><i
                                        class='bx bx-edit-alt'></i></a>
                                <a class="itrash"><i class='bx bx-trash'></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Các dòng khác... -->
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
            str += '<li class="page-item previous no"><a onclick="createPagination(pages, ' + (page - 1) +
                ')"><i class="bx bx-chevron-left"></i></a></li>';
        }
        if (pages < 6) {
            for (let p = 1; p <= pages; p++) {
                active = page == p ? "active" : "no";
                str += '<li class="' + active + '"><a onclick="createPagination(pages, ' + p + ')">' + p + '</a></li>';
            }
        } else {
            if (page > 2) {
                str += '<li class="no page-item"><a onclick="createPagination(pages, 1)">1</a></li>'
                if (page > 3) {
                    str += '<li class="out-of-range"><a onclick="createPagination(pages, ' + (page - 2) +
                        ')">...</a></li>'
                }
            }
            if (page === 1) {
                pageCutHigh += 2;
            } else if (page === 2) {
                pageCutHigh += 1;
            }
            if (page === pages) {
                pageCutLow -= 2;
            } else if (page === pages - 1) {
                pageCutLow -= 1;
            }
            for (let p = pageCutLow; p < pageCutHigh; p++) {
                if (p === 0) {
                    p += 1;
                }
                if (p > pages) {
                    continue;
                }
                active = page == p ? "active" : "no";
                str += '<li class="page-item ' + active + '"><a onclick="createPagination(pages, ' + p + ')">' + p +
                    '</a></li>'
            }
            if (page < pages - 1) {
                if (page < pages - 2) {
                    str += '<li class="out-of-range"><a onclick="createPagination(pages,' + (page + 2) +
                        ')">...</a></li>';
                }
                str += '<li class="page-item no"><a onclick="createPagination(pages, pages)">' + pages + '</a></li>';
            }
        }
        if (page < pages) {
            str += '<li class="page-item next no"><a onclick="createPagination(pages, ' + (page + 1) +
                ')"><i class="bx bx-chevron-right"></i></a></li>';
        }
        str += '</ul>';
        document.getElementById('pagination').innerHTML = str;
        return str;
    }
    </script>
    <?php
    }
    ?>
</body>

</html>