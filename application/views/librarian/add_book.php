<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      New Book
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Add</li>
      <li>New</li>
      <li class="active">Book</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
	<div class="row">
	    <div class="col-md-12">
	      	<div class="box box-info">
	            <div class="box-header with-border">
	              	<h3 class="box-title">New Book Data</h3>
	            </div>
	            <?php
                  if (isset($this->session->userdata['error_message'])) {
                      echo "<span style=\"color: red;text-align: center; font-weight: bold\">
                              <div>
                                <p>".$this->session->userdata['error_message']."</p>
                              </div>
                            </span>";
                  }
                  else if(isset($this->session->userdata['bookID'])){
                    echo "<span style=\"color: green;text-align: center; font-weight: bold\">
                            <div>
                              <p> New Book (ID #: ".$this->session->userdata['bookID'].") has been acquired!</p>
                            </div>
                          </span>";
                  }
                echo form_open('Librarian/addBook'); ?>
	          	<div class="box-body">
	          		<div class="row clearfix">

						<div class="col-md-6">
							<label for="title" class="control-label"><span class="text-danger">*</span>Title</label>
							<div class="form-group">
								<input type="text" name="title" value="<?php echo $this->input->post('title'); ?>" class="form-control" id="title" />
								<span class="text-danger"><?php echo form_error('title');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="ISBN" class="control-label"><span class="text-danger">*</span>ISBN</label>
							<div class="form-group">
								<input type="text" name="ISBN" value="<?php echo $this->input->post('ISBN'); ?>" class="form-control" id="ISBN" />
								<span class="text-danger"><?php echo form_error('ISBN');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="author" class="control-label"><span class="text-danger">*</span>Author</label>
							<div class="form-group">
								<textarea name="author" class="form-control" id="author"><?php echo $this->input->post('author'); ?></textarea>
								<span class="text-danger"><?php echo form_error('author');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="editor" class="control-label"><span class="text-danger">*</span>Editor</label>
							<div class="form-group">
								<textarea name="editor" class="form-control" id="editor"><?php echo $this->input->post('editor'); ?></textarea>
								<span class="text-danger"><?php echo form_error('editor');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="language" class="control-label"><span class="text-danger">*</span>Language</label>
							<div class="form-group">
								<select name="language" class="form-control">
									<option value="">select</option>
									<?php 
									$language_values = array(
										'filipino'=>'Filipino',
										'english'=>'English',
										'mandrin'=>'mandarin',
										'japanese'=>'japanese',
									);

									foreach($language_values as $value => $display_text)
									{
										$selected = ($value == $this->input->post('language')) ? ' selected="selected"' : "";

										echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('language');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="category" class="control-label"><span class="text-danger">*</span>Category</label>
							<div class="form-group">
								<select name="category" class="form-control">
									<option value="">select</option>
									<?php 
									$category_values = array(
										'Drama'=>'Drama',
										'Mathematics'=>'Mathematics',
										'Computer Science'=>'Computer Science',
										'Linguistics'=>'Linguistics',
										'Engineering'=>'Engineering',
										'History'=>'History',
										'Reearch'=>'Research',
										'Thesis'=>'Thesis',
										'Magazine'=>'Magazine',
									);

									foreach($category_values as $value => $display_text)
									{
										$selected = ($value == $this->input->post('category')) ? ' selected="selected"' : "";

										echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('category');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="section" class="control-label"><span class="text-danger">*</span>Section</label>
							<div class="form-group">
								<select name="section" class="form-control">
									<option value="">select</option>
									<?php 
									$section_values = array(
										'Circulation'=>'Circulation',
										'Reference'=>'Reference',
										'Serials'=>'Serials',
										'Archives'=>'Archives',
									);

									foreach($section_values as $value => $display_text)
									{
										$selected = ($value == $this->input->post('section')) ? ' selected="selected"' : "";

										echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
									} 
									?>
								</select>
								<span class="text-danger"><?php echo form_error('section');?></span>
							</div>
						</div>
						<div class="col-md-6">
							<label for="price" class="control-label"><span class="text-danger">*</span>Price (Php.)</label>
							<div class="form-group">
								<input type="text" name="price" value="<?php echo $this->input->post('price'); ?>" class="form-control" id="price" />
								<span class="text-danger"><?php echo form_error('price');?></span>
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