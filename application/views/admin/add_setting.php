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
                else if(isset($school))
                              echo $school["name"];
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
                        else if(isset($school))
                                    echo $school["name"]."'s ";
                        else echo "School's ";
                      ?> Settings</h3>
                </div>
                <?php echo form_open('Admin/addSettings'); ?>
              	<div class="box-body">
                  <?php
                    if (isset($this->session->userdata['error_message'])) {
                        echo "<span style=\"color: red;text-align: center; font-weight: bold\" id = \"result\" name = \"result\">
                                <div>
                                  <p>".$this->session->userdata['error_message']."</p>
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
    					      <div class="col-md-12">
                      <div class="row">
              					<div class="col-md-6">
              						<label for="id" class="control-label"><span class="text-danger">*</span>ID</label>
              						<div class="form-group">
              							<input type="text" name="id"
                              value="<?php
                                  if(isset($this->session->userdata['school']['id']))
                                    echo $this->session->userdata['school']['id'];
                                  else if(isset($setting))
                                    echo $setting['id'];
                                  ?>"
                              class="form-control" id="id" readonly/>
              							<span class="text-danger"><?php echo form_error('id');?></span>
              						</div>
              					</div>
                        <div class="col-md-6">
              						<label for="school" class="control-label"><span class="text-danger">*</span>School</label>
              						<div class="form-group">
                            <input type="text" name="school"
                              value="<?php
                                  if(isset($this->session->userdata['school']['schoolID']))
                                    echo $this->session->userdata['school']['schoolID'];
                                  else if(isset($setting))
                                    echo $setting['school'];
                                  ?>"
                              class="form-control" id="school" readonly/>
              							<span class="text-danger"><?php echo form_error('school');?></span>
                          </div>
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
              							<input type="text" name="days_teacher"
                              value="<?php
                                  if(isset($setting['days_teacher']))
                                    echo $setting['days_teacher'];
                                  ?>"
                              class="form-control" id="days_teacher" />
              							<span class="text-danger"><?php echo form_error('days_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_student" class="control-label">Student</label>
              						<div class="form-group">
              							<input type="text" name="days_student"
                              value="<?php
                                  if(isset($setting['days_student']))
                                    echo $setting['days_student'];
                                  ?>"
                              class="form-control" id="days_student" />
              							<span class="text-danger"><?php echo form_error('days_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="days_outsider" class="control-label">Outsider</label>
              						<div class="form-group">
              							<input type="text" name="days_outsider"
                              value="<?php
                                  if(isset($setting['days_outsider']))
                                    echo $setting['days_outsider'];
                                  ?>"
                              class="form-control" id="days_outsider" />
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
              						<label for="num_teacher" class="control-label">Teacher</label>
              						<div class="form-group">
              							<input type="text" name="num_teacher"
                              value="<?php
                                  if(isset($setting['num_teacher']))
                                    echo $setting['num_teacher'];
                                  ?>"
                              class="form-control" id="num_teacher" />
              							<span class="text-danger"><?php echo form_error('num_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="num_student" class="control-label">Student</label>
              						<div class="form-group">
              							<input type="text" name="num_student"
                              value="<?php
                                  if(isset($setting['num_student']))
                                    echo $setting['num_student'];
                                  ?>"
                              class="form-control" id="num_student" />
              							<span class="text-danger"><?php echo form_error('num_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="num_outsider" class="control-label">Outsider</label>
              						<div class="form-group">
              							<input type="text" name="num_outsider"
                              value="<?php
                                  if(isset($setting['num_outsider']))
                                    echo $setting['num_outsider'];
                                  ?>"
                               class="form-control" id="num_outsider" />
              							<span class="text-danger"><?php echo form_error('num_outsider');?></span>
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
              						<label for="lost_teacher" class="control-label">Teacher (%)</label>
              						<div class="form-group">
              							<input type="text" name="lost_teacher"
                              value="<?php
                                  if(isset($setting['lost_teacher']))
                                    echo $setting['lost_teacher'];
                                  ?>"
                              class="form-control" id="lost_teacher" />
              							<span class="text-danger"><?php echo form_error('lost_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="lost_student" class="control-label">Student (%)</label>
              						<div class="form-group">
              							<input type="text" name="lost_student"
                              value="<?php
                                  if(isset($setting['lost_student']))
                                    echo $setting['lost_student'];
                                  ?>"
                              class="form-control" id="lost_student" />
              							<span class="text-danger"><?php echo form_error('lost_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="lost_outsider" class="control-label">Outsider (%)</label>
              						<div class="form-group">
              							<input type="text" name="lost_outsider"
                              value="<?php
                                  if(isset($setting['lost_outsider']))
                                    echo $setting['lost_outsider'];
                                  ?>"
                              class="form-control" id="lost_outsider" />
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
              							<input type="text" name="fines_teacher"
                              value="<?php
                                  if(isset($setting['fines_teacher']))
                                    echo $setting['fines_teacher'];
                                  ?>"
                              class="form-control" id="fines_teacher" />
              							<span class="text-danger"><?php echo form_error('fines_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="fines_student" class="control-label">Student (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="fines_student"
                              value="<?php
                                  if(isset($setting['fines_student']))
                                    echo $setting['fines_student'];
                                  ?>"
                              class="form-control" id="fines_student" />
              							<span class="text-danger"><?php echo form_error('fines_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="fines_outsider" class="control-label">Outsider (Php.)</label>
              						<div class="form-group">
              							<input type="text" name="fines_outsider"
                              value="<?php
                                  if(isset($setting['fines_outsider']))
                                    echo $setting['fines_outsider'];
                                  ?>"
                              class="form-control" id="fines_outsider" />
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
              							<input type="text" name="broken_teacher"
                              value="<?php
                                  if(isset($setting['broken_teacher']))
                                    echo $setting['broken_teacher'];
                                  ?>"
                              class="form-control" id="broken_teacher" />
              							<span class="text-danger"><?php echo form_error('broken_teacher');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="broken_student" class="control-label">Student (%)</label>
              						<div class="form-group">
              							<input type="text" name="broken_student"
                              value="<?php
                                  if(isset($setting['broken_student']))
                                    echo $setting['broken_student'];
                                  ?>"
                              class="form-control" id="broken_student" />
              							<span class="text-danger"><?php echo form_error('broken_student');?></span>
              						</div>
              					</div>
              					<div class="col-md-4">
              						<label for="broken_outsider" class="control-label">Outsider (%)</label>
              						<div class="form-group">
              							<input type="text" name="broken_outsider"
                              value="<?php
                                  if(isset($setting['broken_outsider']))
                                    echo $setting['broken_outsider'];
                                  ?>"
                              class="form-control" id="broken_outsider" />
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
