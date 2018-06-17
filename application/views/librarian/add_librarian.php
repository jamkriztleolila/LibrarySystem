<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Librarian
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Add</li>
      <li class="active">Librarian</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        	<div class="box box-info">
              <div class="box-header with-border">
                	<h3 class="box-title">Librarian Information</h3>
              </div>
              <?php echo form_open('Admin/addLibrarian'); ?>
            	<div class="box-body">

                <?php
                  if (isset($this->session->userdata['error_message'])) {
                      echo "<span style=\"color: red;text-align: center; font-weight: bold\">
                              <div>
                                <p>".$this->session->userdata['error_message']."</p>
                              </div>
                            </span>";
                  }
                  else if(isset($this->session->userdata['result'])){
                    echo "<span style=\"color: green;text-align: center; font-weight: bold\">
                            <div>
                              <p> New Teacher (ID #: ".$this->session->userdata['result']['id'].") has been registered!</p>
                            </div>
                          </span>";
                  }
                ?>
                </span>
            		<div class="row clearfix">
      					  <div class="col-md-12">
        						<label for="schoolId" class="control-label"><span class="text-danger">*</span>SchoolId</label>
        						<div class="form-group">
        							<input type="text" name="schoolId" value="<?php echo $this->input->post('schoolId'); ?>"
                      class="form-control" id="schoolId" style = "width: 48%"/>
        							<span class="text-danger"><?php echo form_error('schoolId');?></span>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<label for="school" class="control-label"><span class="text-danger">*</span>School</label>
        						<div class="form-group">
        							<select name="school" class="form-control">
                        <option disabled selected value> - - Select School - - </option>
                        <?php
                          foreach($schools as $val){
                             echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                          }
                        ?>
        							</select>
        							<span class="text-danger"><?php echo form_error('school');?></span>
        						</div>
        					</div>
                  <div class="col-md-6">
        						<label for="userLevel" class="control-label"><span class="text-danger">*</span>UserLevel</label>
        						<div class="form-group">
        							<select name="userLevel" class="form-control">
        								<option disabled selected value> - - Select Position - - </option>
                        <option value="1">Librarian</option>
                        <option value="2">Assistant Librarian</option>
                        <option value="3">Head Librarian</option>
        							</select>
        						</div>
        					</div>
                  <div class="col-md-4">
        						<label for="firstName" class="control-label"><span class="text-danger">*</span>FirstName</label>
        						<div class="form-group">
        							<input type="text" name="firstName" value="<?php echo $this->input->post('firstName'); ?>" class="form-control" id="firstName" />
        							<span class="text-danger"><?php echo form_error('firstName');?></span>
        						</div>
        					</div>
        					<div class="col-md-4">
        						<label for="middleName" class="control-label">MiddleName</label>
        						<div class="form-group">
        							<input type="text" name="middleName" value="<?php echo $this->input->post('middleName'); ?>" class="form-control" id="middleName" />
        						</div>
        					</div>
        					<div class="col-md-4">
        						<label for="lastName" class="control-label"><span class="text-danger">*</span>LastName</label>
        						<div class="form-group">
        							<input type="text" name="lastName" value="<?php echo $this->input->post('lastName'); ?>" class="form-control" id="lastName" />
        							<span class="text-danger"><?php echo form_error('lastName');?></span>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
        						<div class="form-group">
        							<input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
        							<span class="text-danger"><?php echo form_error('email');?></span>
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
