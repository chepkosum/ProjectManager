<script type="text/javascript">
$(document).ready(function() {
    $('#companies-table').DataTable({
        "ajax": {
            url : "<?php echo site_url("Ari/companies_page") ?>",
            type : 'GET'
        },
    });
});
</script>
 <h1>Reports</h1>
 <table id="companies-table">
<thead>
<tr><td>Company Name</td><td>Description</td><td>Email</td><td>Address</td><td>Postal Code</td><td>Town</td><td></td></tr>
</thead>
<tbody>
</tbody>
</table>
 