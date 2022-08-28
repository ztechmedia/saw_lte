<table class="table table-condensed" id="dtable">
    <thead>
        <th width="8%">No</th>
        <th>Range</th>
        <th>Nama Subkriteria</th>
        <th>Nilai</th>
        <th>Bobot</th>
        <th width="12%">Tindakan</th>
    </thead>
</table>

<script>
     $(document).ready(() => {
        $('#dtable').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?= base_url("admin/subcriterias-table/$critId") ?>",
                "type": "POST"
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "range_value",
                },
                {
                    data: "name",
                },
                {
                    data: "value",
                },
                {
                    data: "weight",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>