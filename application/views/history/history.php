<div class="bg-white p-3 shadow-sm mx-3">
    <div class="d-block">
        <h5 class="d-inline">History</h5>
        <div class="float-right">
            <!-- <a href="#" class="btn btn-primary btnTambah btn-sm "> -->
            </a>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered table-hover" id="example">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="text-center" width="10">No.</th>
                    <th>Name</th>
                    <th>History</th>
                    <th>Created_Date</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($historylog as $am) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $am->name_admin ?></td>
                        <td><?= $am->description ?></td>
                        <td><?= $am->created_date ?></td>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>