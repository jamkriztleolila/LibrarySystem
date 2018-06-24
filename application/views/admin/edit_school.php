<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Librarian
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Edit</li>
      <li class="active">Librarian</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
      	   <div class="box box-info">
              <div class="box-header with-border">
                	<h3 class="box-title">School Edit</h3>
              </div>
			        <?php echo form_open('school/edit/'.$school['id']); ?>
        			<div class="box-body">
        				<div class="row clearfix">
        					<div class="col-md-6">
        						<label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
        						<div class="form-group">
        							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $school['name']); ?>" class="form-control" id="name" />
        							<span class="text-danger"><?php echo form_error('name');?></span>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<label for="address" class="control-label"><span class="text-danger">*</span>Address</label>
        						<div class="form-group">
        							<input type="text" name="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $school['address']); ?>" class="form-control" id="address" />
        							<span class="text-danger"><?php echo form_error('address');?></span>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<label for="contact" class="control-label">Contact</label>
        						<div class="form-group">
        							<input type="text" name="contact" value="<?php echo ($this->input->post('contact') ? $this->input->post('contact') : $school['contact']); ?>" class="form-control" id="contact" />
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="box-footer">
                <button type="submit" class="btn btn-success">
    					         <i class="fa fa-check"></i> Save
  				      </button>
    	        </div>
      			  <?php echo form_close(); ?>
      		 </div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
