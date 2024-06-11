<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Pengajuan</h1>

	<a href="<?= base_url('Pengajuan'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i
				class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Pengajuan</h6>
	</div>

	<?php echo form_open('Pengajuan/update/' . $pengajuan->id_pengajuan); ?>
	<div class="card-body">
		<div class="row">
			<?php echo form_hidden('id_pengajuan', $pengajuan->id_pengajuan) ?>
			<div class="form-group col-md-6">
				<label class="font-weight-bold">Nama Barang</label>
				<?php foreach ($barang as $b) { ?>
					<select class="form-control js__hargabarang" name="id_barang" id="id_barang" required>
						<option value="">
							====PILIH BARANG====
						</option>
						<option value="<?= $b->id_barang ?>" data-id="<?php echo $b->nama_barang ?>" <?php if ($b->id_barang == $pengajuan->id_barang) {
								 echo 'selected';
							 } ?>>
							<?= $b->nama_barang ?>
						</option>

					</select>
				</div>
			<?php } ?>

			<div class="form-group col-md-6">
				<label class="font-weight-bold">Harga</label>
				<input type="text" name="harga" id="harga" class="form-control" onkeyup="sumTotal();"
					value="<?= $pengajuan->harga ?>" required readonly />
			</div>

			<div class="form-group col-md-6">
				<label class="font-weight-bold">Jumlah</label>
				<input autocomplete="off" type="text" name="jumlah" id="jumlah" class="form-control"
					value="<?= $pengajuan->jumlah ?>" onkeyup="sumTotal();" required />
			</div>
			<div class="form-group col-md-6">
				<label class="font-weight-bold">Total</label>
				<input type="text" name="total" id="total" value="<?= $pengajuan->total ?>" class="form-control"
					required readonly />
			</div>



		</div>
	</div>
	<div class="card-footer text-right">
		<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
		<!-- <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button> -->
	</div>
	<?php echo form_close() ?>
</div>

<?php $this->load->view('layouts/footer_admin'); ?>