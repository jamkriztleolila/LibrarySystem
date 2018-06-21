<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add School
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Add</li>
      <li class="active">School</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">School Information</h3>
            </div>
            <?php echo form_open('admin/addSchool'); ?>
          	<div class="box-body" name = "schoolInfo" id = "schoolInfo" data-user="Admin"
                data-url="<?=base_url();?>" data-page="School">
                <?php
                  if (isset($this->session->userdata['error_message'])) {
                      echo "<span style=\"color: red;text-align: center; font-weight: bold\" id = \"result\" name = \"result\">
                              <div>
                                <p>".$this->session->userdata['error_message']."</p>
                              </div>
                            </span>";
                  }
                  else if(isset($this->session->userdata['result'])){
                    echo "<span style=\"color: green;text-align: center; font-weight: bold\" id = \"result\" name = \"result\">
                            <div>
                              <p> New Teacher (ID #: ".$this->session->userdata['result']['id'].") has been registered!</p>
                            </div>
                          </span>";
                  }
                  else{
                    echo "<span style=\"text-align: center; font-weight: bold\">
                            <div>
                              <p  id = \"result\" name = \"result\"></p>
                            </div>
                          </span>";
                  }
                ?>
          		<div class="row clearfix">
            		<div class="col-md-6">
            			<label for="name" class="control-label"><span class="text-danger">*</span>ID:</label>
            			<div class="form-group">
            				<input type="text" name="id" id = "id" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
            				<span class="text-danger"><?php echo form_error('name');?></span>
            			</div>
            		</div>
            		<div class="col-md-6">
            			<label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
            			<div class="form-group">
            				<input type="text" name="name" id="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
            				<span class="text-danger"><?php echo form_error('name');?></span>
            			</div>
            		</div>
            		<div class="col-md-6">
            			<label for="address" class="control-label"><span class="text-danger">*</span>Address</label>
            			<div class="form-group">
            				<input type="text" name="address" id="address" value="<?php echo $this->input->post('address'); ?>" class="form-control" id="address" />
            				<span class="text-danger"><?php echo form_error('address');?></span>
            			</div>
            		</div>
            		<div class="col-md-6">
            			<label for="contact" class="control-label">Contact</label>
            			<div class="form-group">
            				<input type="text" name="contact" id="contact" value="<?php echo $this->input->post('contact'); ?>" class="form-control" id="contact" />
            			</div>
            		</div>
            	</div>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-default">
                <i class="fa fa-refresh"></i> Reset
              </button>
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
