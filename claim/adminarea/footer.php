
  </body>
</html>

<script type="text/javascript" src="../jquery/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable({"order": []});
$(".date").datepicker({dateFormat: "yy-m-dd"});
} );
</script>