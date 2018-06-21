<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      New Settings
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><?php if(isset($this->session->userdata['school']["schoolName"]))
                    echo $this->session->userdata['school']["schoolName"];
                else
                    echo "School";
          ?>
      </li>
      <li class="active">Setting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
          	<div class="box box-info">
                <div class="box-header with-border">
                  	<h3 class="box-title">
                      <?php
                        if(isset($this->session->userdata['school']["schoolName"]))
                          echo $this->session->userdata['school']["schoolName"]."'s ";
                        else echo "School's ";
                      ?> Settings</h3>
                </div>
                <?php echo form_open('Admin/addSettings'); ?>
              	<div class="box-body">
              		<div class="row clearfix">
    					      <div class="col-md-12">
            					<div class="col-md-6"
                        <?php
                          if(!isset($this->session->userdata['school']['schoolID']))
                          echo " hidden ";
                        ?>
                      >
            						<label for="id" class="control-label"><span class="text-danger">*</span>ID</label>
            						<div class="form-group">
            							<input type="text" name="id"
                          value="<?php
                                if(isset($this->session->userdata['school']['id']))
                                  echo $this->session->userdata['school']['id'];
                                ?>"
                            class="form-control" id="id" />
            							<span class="text-danger"><?php echo form_error('id');?></span>
            						</div>
            					</div>
                      <div class="col-md-6">
            						<label for="school" class="control-label"><span class="text-danger">*</span>School</label>
            						<div class="form-group">
            							<select name="school" id="school" class="form-control"
                            <?php
                              if(isset($this->session->userdata['school']['schoolID']))
                              echo " readonly ";
                            ?>
                            >
            								<option value="" disabled
                            <?php
                              if(!isset($this->session->userdata['school']['schoolID']))
                                echo "selected";
                            ?>
                            > - - Select a School - - </option>
            								<?php

            								foreach($schools as $value)
            								{
            									$selected = (isset($this->session->userdata['school']['schoolID']) &&
                                          $value["id"] == $this->session->userdata['school']['schoolID'])
                                          ? ' selected="selected"' : "";
                              $disabled = (isset($this->session->userdata['school']['schoolID']) &&
                                          $value["id"] != $this->session->userdata['school']['schoolID'])
                                          ? ' disabled' : "";

            									echo '<option value="'.$value['id'].'" '.$selected.$disabled.' >'.$value["name"].'</option>';
            								}
            								?>
            							</select>
            							<span class="text-danger"><?php echo form_error('school');?></span>
                        </div>
          						</div>
          					</div>
                    <div class="col-md-12">
                      <div class = "row">
                        <div class = "col-md-12">
                          <label for="" class="control-label"><span class="text-danger">*</span><b>Allowable Borrowing Period (Days):</b></label>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-4">
              						<label for="days_teacher" class="control-label">Teacher</label>
              						<div class="form-group">
              							<input type="text" name="days_teacher" value="<?php echo $this->input->post('days_teacher'); ?>" class="form-control" id="days_teacher" />
              							<span class="text-danger"><?php echo form_error('days_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_student" class="control-label">Student</label>
              						<div class="form-group">
              							<input type="text" name="days_student" value="<?php echo $this->input->post('days_student'); ?>" class="form-control" id="days_student" />
              							<span class="text-danger"><?php echo form_error('days_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_outsider" class="control-label">Outsider</label>
              						<div class="form-group">
              							<input type="text" name="days_outsider" value="<?php echo $this->input->post('days_outsider'); ?>" class="form-control" id="days_outsider" />
              							<span class="text-danger"><?php echo form_error('days_outsider');?></span>
              						</div>
            					  </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class = "row">
                        <div class = "col-md-12">
                          <label for="" class="control-label"><span class="text-danger">*</span><b>Borrowing Limit (per person):</b></label>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-4">
              						<label for="days_teacher" class="control-label">Teacher</label>
              						<div class="form-group">
              							<input type="text" name="days_teacher" value="<?php echo $this->input->post('days_teacher'); ?>" class="form-control" id="days_teacher" />
              							<span class="text-danger"><?php echo form_error('days_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_student" class="control-label">Student</label>
              						<div class="form-group">
              							<input type="text" name="days_student" value="<?php echo $this->input->post('days_student'); ?>" class="form-control" id="days_student" />
              							<span class="text-danger"><?php echo form_error('days_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_outsider" class="control-label">Outsider</label>
              						<div class="form-group">
              							<input type="text" name="days_outsider" value="<?php echo $this->input->post('days_outsider'); ?>" class="form-control" id="days_outsider" />
              							<span class="text-danger"><?php echo form_error('days_outsider');?></span>
              						</div>
              					</div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class = "row">
                        <div class = "col-md-12">
                          <label for="" class="control-label"><span class="text-danger">*</span><b>Penalty for Lost Book (per book):</b></label>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-4">
              						<label for="lost_teacher" class="control-label">Teacher (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="lost_teacher" value="<?php echo $this->input->post('lost_teacher'); ?>" class="form-control" id="lost_teacher" />
              							<span class="text-danger"><?php echo form_error('lost_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="lost_student" class="control-label">Student (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="lost_student" value="<?php echo $this->input->post('lost_student'); ?>" class="form-control" id="lost_student" />
              							<span class="text-danger"><?php echo form_error('lost_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="lost_outsider" class="control-label">Outsider (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="lost_outsider" value="<?php echo $this->input->post('lost_outsider'); ?>" class="form-control" id="lost_outsider" />
              							<span class="text-danger"><?php echo form_error('lost_outsider');?></span>
              						</div>
              					</div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class = "row">
                        <div class = "col-md-12">
                          <label for="" class="control-label"><span class="text-danger">*</span><b>Penalty for Overdue Books (per book):</b></label>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-4">
              						<label for="fines_teacher" class="control-label">Teacher (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="fines_teacher" value="<?php echo $this->input->post('fines_teacher'); ?>" class="form-control" id="fines_teacher" />
              							<span class="text-danger"><?php echo form_error('fines_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="fines_student" class="control-label">Student (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="fines_student" value="<?php echo $this->input->post('fines_student'); ?>" class="form-control" id="fines_student" />
              							<span class="text-danger"><?php echo form_error('fines_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="fines_outsider" class="control-label">Outsider (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="fines_outsider" value="<?php echo $this->input->post('fines_outsider'); ?>" class="form-control" id="fines_outsider" />
              							<span class="text-danger"><?php echo form_error('fines_outsider');?></span>
              						</div>
              					</div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class = "row">
                        <div class = "col-md-12">
                          <label for="" class="control-label"><span class="text-danger">*</span><b>Penalty for damaged book (per book):</b></label>
                        </div>
                      </div>
                      <div class = "row">
                        <div class="col-md-4">
              						<label for="broken_teacher" class="control-label">Teacher (%)</label>
              						<div class="form-group">
              							<input type="text" name="broken_teacher" value="<?php echo $this->input->post('broken_teacher'); ?>" class="form-control" id="broken_teacher" />
              							<span class="text-danger"><?php echo form_error('broken_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="broken_student" class="control-label">Student (%)</label>
              						<div class="form-group">
              							<input type="text" name="broken_student" value="<?php echo $this->input->post('broken_student'); ?>" class="form-control" id="broken_student" />
              							<span class="text-danger"><?php echo form_error('broken_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="broken_outsider" class="control-label">Outsider (%)</label>
              						<div class="form-group">
              							<input type="text" name="broken_outsider" value="<?php echo $this->input->post('broken_outsider'); ?>" class="form-control" id="broken_outsider" />
              							<span class="text-danger"><?php echo form_error('broken_outsider');?></span>
              						</div>
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
