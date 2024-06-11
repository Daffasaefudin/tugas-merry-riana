<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Barang</h1>

	<a href="<?= base_url('Barang'); ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i
				class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Barang</h6>
	</div>

	<?php echo form_open('Barang/update/' . $barang->id_barang); ?>
	<div class="card-body">
		<div class="row">
			<?php echo form_hidden('id_barang', $barang->id_barang) ?>
			<div class="form-group col-md-6">
				<label class="font-weight-bold">Nama Barang</label>
				<input autocomplete="off" type="text" name="nama_barang" value="<?php echo $barang->nama_barang ?>"
					required class="form-control" />
			</div>

			<div class="form-group col-md-6">
				<label class="font-weight-bold">Harga</label>
				<input autocomplete="off" type="text" name="harga" value="<?php echo $barang->harga ?>" required
					class="form-control" />
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