<?php include 'co_action.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ກຳ​ມະ​ການ</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include '../style/stylesheet.php'; ?>

    <style>
        .scrollable-table {
            width: 100%;
            overflow-x: auto;
        }

        .scrollable-table table {
            width: 100%;
            white-space: nowrap;
        }
    </style>


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include '../navbar/navbar_a.php'; ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../sidebar/sidebar_a.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle py-2">
            <h1>ກຳ​ມະ​ການ</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="modal fade" id="addModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ເພີ່ມກຳ​ມະ​ການ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" action="co_action" method="post" enctype="multipart/form-data">
                                                <div class="col-md-12">
                                                    <label for="co_username" class="form-label">ຊື່​ເຂົ້າ​ລະ​ບົບ</label>
                                                    <input type="text" name="co_username" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="co_password" class="form-label">ລະ​ຫັດ</label>
                                                    <input type="text" name="co_password" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="co_name" class="form-label">ຊື່</label>
                                                    <input type="text" name="co_name" class="form-control" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="co_pic" class="form-label">ຮູບ​ພາບ</label>
                                                    <input type="file" name="co_pic" class="form-control">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                            <button type="submit" name="add" class="btn btn-primary">ເພີ່ມ​ຂໍ້​ມູນ</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                ເພີ່ມກຳ​ມະ​ການ
                            </button>

                            <?php
                            $query = "SELECT * FROM counter";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $data = array();
                            while ($row = $result->fetch_assoc()) {
                                $data[] = $row;
                            }
                            ?>
                            <!-- Default Table -->
                            <div class="scrollable-table">
                                <table class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>ລ/ດ</th>
                                            <th>ຮູບ​ພາບ</th>
                                            <th>ຊື່​ເຂົ້າ​ລະ​ບົບ</th>
                                            <th>​ລະ​ຫັດ</th>
                                            <th>​ຊື່</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $row){ ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><img src="../uploads/counter/<?= $row['co_pic']; ?>" width="60"></td>
                                                <td><?= $row['co_username']; ?></td>
                                                <td><?= $row['co_password']; ?></td>
                                                <td><?= $row['co_name']; ?></td>
                                                <td>
                                                    <a href="#edit_<?= $row['co_id']; ?>" type="button" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-pencil-square"></i></a>
                                                    <a data-id="<?= $row['co_id']; ?>" href="co_action?delete=<?= $row['co_id']; ?>" type="button" class="btn btn-danger delete-btn"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="edit_<?= $row['co_id']; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">ແກ້​ໄຂກຳ​ມະ​ການ</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" action="co_action" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="co_id" value="<?= $row['co_id']; ?>">
                                                                <div class="col-md-12">
                                                                    <label for="co_username" class="form-label">ຊື່​ເຂົ້າ​ລະ​ບົບ</label>
                                                                    <input type="text" name="co_username" value="<?= $row['co_username']; ?>" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="co_password" class="form-label">ລະ​ຫັດ</label>
                                                                    <input type="text" name="co_password" value="<?= $row['co_password']; ?>" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="co_name" class="form-label">ຊື່</label>
                                                                    <input type="text" name="co_name" value="<?= $row['co_name']; ?>" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="co_pic" class="form-label">ຮູບ​ພາບ</label>
                                                                    <input type="hidden" name="oldpic" value="<?= $row['co_pic']; ?>">
                                                                    <input type="file" name="co_pic" class="form-control mb-2">
                                                                    <img src="../uploads/counter/<?= $row['co_pic']; ?>" width="120" class="img-thumbnail">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                                                            <button type="submit" name="update" class="btn btn-success">ອັບ​ເດດ​ຂໍ້​ມູນ</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->



    <?php include '../style/script.php'; ?>

    <script>
        $(function() {
            $("#example").DataTable({
                "oLanguage": {
                    "sProcessing": "ກຳລັງດຳເນີນການ...",
                    "sLengthMenu": "ສະແດງ _MENU_ ແຖວ",
                    "sZeroRecords": "ບໍ່ມີຂໍ້ມູນຄົ້ນຫາ",
                    "sInfo": "ສະແດງ _START_ ຖີງ _END_ ຈາກ _TOTAL_ ແຖວ",
                    "sInfoEmpty": "ສະແດງ 0 ຖີງ 0 ຈາກ 0 ແຖວ",
                    "sInfoFiltered": "(ຈາກຂໍ້ມູນທັງໝົດ _MAX_ ແຖວ)",
                    "sSearch": "ຄົ້ນຫາ :",
                    "oPaginate": {
                        "sFirst": "ເລີ່ມຕົ້ນ",
                        "sPrevious": "ກັບຄືນ",
                        "sNext": "ຕໍ່ໄປ",
                        "sLast": "ສຸດທ້າຍ"
                    }
                },
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });

        $(".delete-btn").click(function(e) {
            let userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'ຕ້ອງການຈະລົບຂໍ້ມູນອອກບໍ່?',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ຕົກລົງ',
                cancelButtonText: 'ຍົກເລີກ',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'co_action',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'ລົບຂໍ້ມູນສຳເລັດແລ້ວ',

                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'counter';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>

</body>

</html>