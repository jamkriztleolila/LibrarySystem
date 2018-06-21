div class="content-wrapper">
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
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Schools Listing</h3>
                <div class="box-tools">
                      <a href="<?php echo site_url('school/add'); ?>" class="btn btn-success btn-sm">Add</a>
                  </div>
              </div>
              <div class="box-body">
                  <table class="table table-striped">
                      <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Address</th>
              <th>Contact</th>
              <th>Actions</th>
                      </tr>
                      <?php foreach($schools as $s){ ?>
                      <tr>
              <td><?php echo $s['id']; ?></td>
              <td><?php echo $s['name']; ?></td>
              <td><?php echo $s['address']; ?></td>
              <td><?php echo $s['contact']; ?></td>
              <td>
                              <a href="<?php echo site_url('school/edit/'.$s['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a>
                              <a href="<?php echo site_url('school/remove/'.$s['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                          </td>
                      </tr>
                      <?php } ?>
                  </table>
                  <div class="pull-right">
                      <?php echo $this->pagination->create_links(); ?>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
</div>
