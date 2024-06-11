<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Historis Pengajuan</h1>

</div>

<?= $this->session->flashdata('message'); ?>


<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Historis Pengajuan</h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-dark text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama Barang</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Tanggal Approve</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($list as $data => $value) {
						?>
						<tr align="center">
							<td><?= $no ?></td>
							<td><?php echo $value->nama_barang ?></td>
							<td><?php echo $value->harga ?></td>
							<td><?php echo $value->jumlah ?></td>
							<td><?php echo $value->total ?></td>
							<td><?php echo $value->tanggal_approve ?></td>
						</tr>
						<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?php $this->load->view('layouts/footer_admin'); ?>