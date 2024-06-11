<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Pengajuan</h1>
	<?php if ($this->session->userdata('level') == "OFFICER") { ?>
		<div>
			<a href="<?= base_url('Pengajuan/create'); ?>" class="btn btn-info"> <i class="fa fa-plus"></i> Tambah Data </a>

		</div>
	<?php } ?>
</div>

<?= $this->session->flashdata('message'); ?>


<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Pengajuan</h6>
	</div>
	<?php if ($this->session->userdata('level') == 'OFFICER') { ?>
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
							<th>Status</th>
							<th>Alasan Rejected</th>
							<th>Bukti Transfer</th>
							<th width="15%">Aksi</th>
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

								<td>
									<?php
									if ($value->approve == "PROSESM") {
										echo "Sedang Diproses oleh Manager";
									} else if ($value->approve == "PROSESF") {
										echo "Sedang Diproses oleh Finance";
									} else if ($value->approve == "APPROVED") {
										echo "Approved";
									} else if ($value->approve == "REJECTED") {
										echo "Rejected";
									}
									?>
								</td>
								<td><?php echo $value->alasan ?></td>
								<td><?php echo $value->bukti ?></td>
								<td>
									<div class="btn-group" role="group">
										<a data-toggle="tooltip" data-placement="bottom" title="Edit Data"
											href="<?= base_url('Pengajuan/edit/' . $value->id_pengajuan) ?>"
											class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
										<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
											href="<?= base_url('Pengajuan/destroy/' . $value->id_pengajuan) ?>"
											onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')"
											class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
									</div>
								</td>
							</tr>
							<?php
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php } ?>
	<?php if ($this->session->userdata('level') == 'MANAGER') { ?>
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
							<th>Status</th>
							<th width="15%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($list1 as $data1 => $value1) {
							?>
							<tr align="center">
								<td><?= $no ?></td>
								<td><?php echo $value1->nama_barang ?></td>
								<td><?php echo $value1->harga ?></td>
								<td><?php echo $value1->jumlah ?></td>
								<td><?php echo $value1->total ?></td>
								<td>
									<?php
									if ($value1->approve == "PROSESM") {
										echo "Perlu Di Approve";
									}
									?>
								</td>
								<td>
									<div class="btn-group" role="group">
										<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data"
											href="<?= base_url('Pengajuan/approve_manager/' . $value1->id_pengajuan) ?>"
											onclick="return confirm ('Apakah anda yakin untuk Approve data ini')"
											class="btn btn-success btn-sm">Approve<i class="fas fa-check"></i></a>
										<button type="button" data-toggle="modal" data-target="#rejectModal1"
											class="btn btn-danger btn-sm" data-id="<?= $value1->id_pengajuan ?>">
											Reject
											<i class="fas fa-times"></i>
										</button>
									</div>
								</td>
							</tr>
							<?php
							$no++;
						}
						?>
					</tbody>
				</table>
				<!-- Reject Modal -->
				<div class="modal fade" id="rejectModal1" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="rejectModalLabel">Reject Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('Pengajuan/reject') ?>" method="post">
								<div class="modal-body">
									<input type="hidden" name="id_pengajuan" id="id_pengajuan" value="">
									<div class="form-group">
										<label for="reason">Alasan Rejection</label>
										<textarea class="form-control" name="alasan" id="alasan" rows="3"
											required></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-danger">Reject</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if ($this->session->userdata('level') == 'FINANCE') { ?>
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
							<th>Status</th>
							<th>Bukti Transfer</th>
							<th width="15%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($list2 as $data2 => $value2) {
							?>
							<tr align="center">
								<td><?= $no ?></td>
								<td><?php echo $value2->nama_barang ?></td>
								<td><?php echo $value2->harga ?></td>
								<td><?php echo $value2->jumlah ?></td>
								<td><?php echo $value2->total ?></td>

								<td>
									<?php
									if ($value2->approve == "PROSESF") {
										echo "Perlu Di Approve";
									} else if ($value2->approve == "APPROVED") {
										echo "Approved";
									}
									?>
								</td>
								<td><?php echo $value2->bukti ?></td>
								<td>
									<?php
									if ($value2->approve == "PROSESF") {
										?>
										<div class="btn-group" role="group">

											<button type="button" data-toggle="modal" data-target="#approveModal"
												class="btn btn-success btn-sm" data-id="<?= $value2->id_pengajuan ?>">
												Approve
												<i class="fas fa-check"></i>
											</button>

											<button type="button" data-toggle="modal" data-target="#rejectModal2"
												class="btn btn-danger btn-sm" data-id="<?= $value2->id_pengajuan ?>">
												Reject
												<i class="fas fa-times"></i>
											</button>
										</div>
									<?php } ?>
								</td>
							</tr>
							<?php
							$no++;
						}
						?>
					</tbody>
				</table>
				<!-- Approve Modal -->
				<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="approveModalLabel">Approve Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('Pengajuan/approve_finance') ?>" method="post"
								enctype="multipart/form-data">
								<div class="modal-body">
									<input type="hidden" name="id_pengajuan" id="approve_id_pengajuan" value="">

									<div class="form-group">
										<label for="bukti">Upload Bukti Transfer</label>
										<input type="file" class="form-control" name="bukti" id="bukti" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-success">Approve</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Reject Modal -->
				<div class="modal fade" id="rejectModal2" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
					aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="rejectModalLabel">Reject Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('Pengajuan/reject') ?>" method="post">
								<div class="modal-body">
									<input type="hidden" name="id_pengajuan" id="id_pengajuan" value="">
									<div class="form-group">
										<label for="reason">Alasan Rejection</label>
										<textarea class="form-control" name="alasan" id="alasan" rows="3"
											required></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-danger">Reject</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>


<?php $this->load->view('layouts/footer_admin'); ?>