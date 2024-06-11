</div>
</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>

<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script>
  $(function () {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Set id_pengajuan in the modal when the Approve button is clicked
    $('#approveModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var idPengajuan = button.data('id'); // Extract info from data-* attributes

      // Update the modal's content.
      var modal = $(this);
      modal.find('#approve_id_pengajuan').val(idPengajuan);
    });
  });
</script>
<script>
  $(function () {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Set id_pengajuan in the modal when the Reject button is clicked
    $('#rejectModal1').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var idPengajuan = button.data('id'); // Extract info from data-* attributes

      // Update the modal's content.
      var modal = $(this);
      modal.find('#id_pengajuan').val(idPengajuan);
    });
  });
</script>
<script>
  $(function () {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Set id_pengajuan in the modal when the Reject button is clicked
    $('#rejectModal2').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var idPengajuan = button.data('id'); // Extract info from data-* attributes

      // Update the modal's content.
      var modal = $(this);
      modal.find('#id_pengajuan').val(idPengajuan);
    });
  });
</script>
<script>

  $('.js__hargabarang').change(function () {
    var id = $('option:selected', this).val()
    var dataId = $('option:selected', this).attr('data-id')

    console.log(id, dataId)
    $.ajax({
      url: 'http://localhost/pembelian-barang/index.php/api/harga/harga/' + id,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response.data1)
        if (response !== null) {
          $('#harga').val(response.data1[0].harga)

        }
      }
    })
  })
</script>
<script>
  function sumTotal() {
    var txtFirstNumberValue = document.getElementById('harga').value;
    var txtSecondNumberValue = document.getElementById('jumlah').value;
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);

    if (!isNaN(result)) {
      total.value = result;

    }
  }
</script>
</body>

</html>