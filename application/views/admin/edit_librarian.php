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
              	<h3 class="box-title">Librarian Information</h3>
            </div>
            <?php
              if (isset($this->session->userdata['error_message'])) {
                echo "<span style=\"color: red; text-align: center; font-weight: bold\">
                        <div>
                          <p id = \"result\" name = \"result\">".
                            $this->session->userdata['error_message'].
                          "</p>
                        </div>
                      </span>";
              }
              else if (isset($this->session->userdata['success_message'])) {
                echo "<span style=\"color: green; text-align: center; font-weight: bold\">
                        <div>
                          <p id = \"result\" name = \"result\">".
                            $this->session->userdata['success_message'].
                          "</p>
                        </div>
                      </span>";
              }
              else{
                echo "<span style=\"text-align: center; font-weight: bold\">
                        <div>
                          <p id = \"result\" name = \"result\"></p>
                        </div>
                      </span>";
              }

              echo form_open('Admin/editLibrarian');
            ?>
      			<div class="box-body" name = "userInfo" id = "userInfo" data-user="Admin"
                data-url="<?=base_url();?>" data-page="Librarian" data-edit="viewInfoLibrarian" data-avail = "viewAvailLibrarian">
      				<div class="row clearfix">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label for="school" class="control-label"><span class="text-danger">*</span>School</label>
                    <div class="form-group">
                      <select name="userSchool" id ="userSchool" class="form-control">
                        <option value=""> - - Select School - - </option>
                        <?php
                          foreach($schools as $val){
                            if(isset($this->session->userdata['user']['userSchool'])
                                && $this->session->userdata['user']['userSchool'] == $val['id'])
                              echo '<option value="'.$val['id'].'" selected>'.$val['name'].'</option>';
                            else
                              echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                          }
                        ?>
                      </select>
                      <span class="text-danger"><?php echo form_error('school');?></span>
                    </div>
                  </div>
        					<div class="col-md-5">
        						<label for="id" class="control-label"><span class="text-danger">*</span>Librarian ID #:</label>
        						<div class="form-group">
        							<select name="userID" id = "userID" class="form-control"
                        <?php
                          if (!isset($this->session->userdata['user']['userID'])) echo "disabled";
                        ?>>
        								<option value=""> - - Select Librarian ID - - </option>
                        <?php
                          if(isset($librarian)){
                            foreach($librarian as $val){
                              if(isset($this->session->userdata['user']['userID'])
                                  && $this->session->userdata['user']['schoolId'] == $val['schoolId'])
                                echo '<option value="'.$val['schoolId'].'" selected>'.$val['schoolId'].'</option>';
                              else
                                echo '<option value="'.$val['schoolId'].'">'.$val['schoolId'].'</option>';
                            }
                          }
                        ?>
        							</select>
        							<span class="text-danger"><?php echo form_error('id');?></span>
        						</div>
        					</div>
                  <div class="col-md-3" style = "display: flex; align-items: center; justify-content: center; height: 11%">
                    <button type="button" class="btn btn-default" onclick = "editUser()">
            					<i class="fa fa-search"></i> Search
            				</button>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label for="schoolId" class="control-label"><span class="text-danger">*</span>School Id</label>
                    <div class="form-group">
                      <input type="text" name="schoolId"
                      value= "<?php if(isset($this->session->userdata['user']['schoolId']))
                              echo $this->session->userdata['user']['schoolId'] ?>"
                      class="form-control" id="schoolId" />
                      <span class="text-danger"><?php echo form_error('schoolId');?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="userType" class="control-label">User Type:</label>
                    <div class="form-group">
                      <input type="text" name="userType" id = "userType"
                      value= "<?php if(isset($this->session->userdata['user']['userType']))
                              echo $this->session->userdata['user']['userType'] ?>"
                      class="form-control" id="schoolId" readonly/>
                      <span class="text-danger"><?php echo form_error('schoolId');?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-4">
        						<label for="firstName" class="control-label"><span class="text-danger">*</span>FirstName</label>
        						<div class="form-group">
        							<input type="text" name="firstName"
                      value= "<?php if(isset($this->session->userdata['user']['firstName']))
                              echo $this->session->userdata['user']['firstName'] ?>"
                      class="form-control" id="firstName" />
        							<span class="text-danger"><?php echo form_error('firstName');?></span>
        						</div>
        					</div>
        					<div class="col-md-4">
        						<label for="middleName" class="control-label">MiddleName</label>
        						<div class="form-group">
        							<input type="text" name="middleName"
                      value= "<?php if(isset($this->session->userdata['user']['middleName']))
                              echo $this->session->userdata['user']['middleName'] ?>"
                      class="form-control" id="middleName" />
        						</div>
        					</div>
        					<div class="col-md-4">
        						<label for="lastName" class="control-label"><span class="text-danger">*</span>LastName</label>
        						<div class="form-group">
        							<input type="text" name="lastName"
                      value= "<?php if(isset($this->session->userdata['user']['lastName']))
                              echo $this->session->userdata['user']['lastName'] ?>"
                      class="form-control" id="lastName" />
        							<span class="text-danger"><?php echo form_error('lastName');?></span>
        						</div>
        					</div>
        					<div class="col-md-12">
        						<label for="email" class="control-label"><span class="text-danger">*</span>Email</label>
        						<div class="form-group">
        							<input type="text" name="email"
                      value= "<?php if(isset($this->session->userdata['user']['email']))
                              echo $this->session->userdata['user']['email'] ?>"
                      class="form-control" id="email" />
        							<span class="text-danger"><?php echo form_error('email');?></span>
        						</div>
        					</div>
                </div>
      				</div>
      			</div>
      			<div class="box-footer"  style = "display: flex; align-items: center; justify-content: center;">
              	<button type="button" class="btn btn-danger" style = "margin:1%" id = "deactivateBtn"
                name = "deactivateBtn" onclick = "deactivateUser()"
                  <?php
                    if (!isset($this->session->userdata['user'])) echo "disabled";
                  ?>>
        					<i class="fa fa-ban"></i> Deactivate
        				</button>
                <button type="submit" class="btn btn-success" style = "margin:1%" id = "saveBtn"
                  name = "saveBtn"
                  <?php
                    if (!isset($this->session->userdata['user'])) echo "disabled";
                  ?>>
        					<i class="fa fa-check"></i> Save
        				</button>
                <button type="button" class="btn btn-warning" style = "margin:1%"  id = "resetBtn"
                  name = "resetBtn" onclick = "resetPassword()"
                  <?php
                    if (!isset($this->session->userdata['user'])) echo "disabled";
                  ?>>
        					<i class="fa fa-refresh"></i> Reset Password
        				</button>
  	        </div>
      			<?php echo form_close(); ?>
      		</div>
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
