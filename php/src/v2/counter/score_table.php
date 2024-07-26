<?php
include '../config.php';
$query = "SELECT sum(sc.sc_result) as scres, c.c_id, c.c_name,c.c_age, c.c_part, c.c_pic FROM score as sc right join candidate as c on sc.c_id = c.c_id group by c.c_name order by scres DESC, c.c_id ASC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>
<table class="table table-bordered" id="table">
    <thead>
        <tr class="text-center align-middle" style="height: 80px;">
            <th width="9%" class="fs-3">ລ/ດ</th>
            <th width="15%" class="fs-3">ຮູບ​ພາບ</th>
            <th width="22%" class="fs-3">ຊື່​ຜູ້​ສະ​ໝັກ</th>
            <th width="10%" class="fs-3">ອາ​ຍຸ</th>
            <th width="29%" class="fs-3">ບ່ອນ​ປະ​ຈຳ​ການ</th>
            <th width="15%" class="fs-3">​ຄະ​ແນນ</th>
        </tr>
    </thead>
    <tbody class="align-middle">
        <?php $i = 1; ?>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td class="text-center fs-4" width="9%"><?= $i++; ?></td>
                <td class="text-center" width="15%">
                    <?php if ($row['c_pic'] != "") { ?>
                        <img src="../uploads/candidate/<?= $row['c_pic']; ?>" width="75" height="80" class="rounded-circle">
                    <?php } else { ?>
                        <img src="../assets/img/profile-picture.jpg" alt="Profile" width="75" height="80" class="rounded-circle">
                    <?php } ?>
                </td>
                <td width="22%" class="fs-4"><?= $row['c_name']; ?></td>
                <td width="10%" class="fs-4 text-center"><?= $row['c_age']; ?></td>
                <td width="29%" class="fs-4 text-center"><?= $row['c_part']; ?></td>
                <?php if ($row['scres']) { ?>
                    <td class="text-center fs-4 fw-bold" width="15%"><?= $row['scres']; ?></td>
                <?php } else { ?>
                    <td class="text-center fs-4 fw-bold" width="15%">0</td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <?php
        $query1 = "SELECT sum(sc_result) as scres FROM score";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        ?>
        <?php while ($row1 = $result1->fetch_assoc()) { ?>
            <tr class="text-center align-middle" style="height: 80px;">
                <th colspan="5" class="fs-3">ລວມ​ຄະ​ແນນ​ທັງ​ໝົດ</th>
                <?php if ($row1['scres']) { ?>
                    <td class="text-center fs-3 fw-bold" width="15%"><?= $row1['scres']; ?></td>
                <?php } else { ?>
                    <td class="text-center fs-3 fw-bold" width="15%">0</td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tfoot>
</table>