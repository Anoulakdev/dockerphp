<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ເພີ່ມຜູ້​ແທນ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="m_action" method="post">
                    <div class="col-md-12">
                        <label for="m_code" class="form-label">​ລະ​ຫັດ​ພະ​ນັກ​ງານ</label>
                        <input type="text" name="m_code" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label for="m_name" class="form-label">​ຊື່ ແລະ ນາມ​ສະ​ກຸນ</label>
                        <input type="text" name="m_name" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label for="m_part" class="form-label">ກົມ​ກອງ​ບ່ອນ​ປະ​ຈຳ​ການ</label>
                        <input type="text" name="m_part" class="form-control" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">​ປິດ</button>
                <button type="submit" name="add" class="btn btn-primary" onclick="loads()">ເພີ່ມ​ຂໍ້​ມູນ</button>
                <button class="btn btn-primary" type="button" disabled id="load">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    ກຳ​ລັງ​ບັນ​ທຶກ...
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("load").style.display = "none"

    function loads() {
        document.getElementById("add").style.display = "none"
        document.getElementById("load").style.display = "inline"
    }
</script>