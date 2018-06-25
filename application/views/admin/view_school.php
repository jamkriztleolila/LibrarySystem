<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Schools
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>View</li>
      <li class="active">Schools</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Schools Listing</h3>
              </div>
              <div class="box-body">
                <div style="overflow-x:auto;">
                  <table class="table table-striped">
                      <tr>
                        <th>ID</th>
                        <th nowrap>Name</th>
                        <th nowrap>Address</th>
                        <th nowrap>Contact</th>
                        <th nowrap>Status</th>
                      </tr>
                      <?php foreach($schools as $s){ ?>
                      <tr>
                        <td><?php echo $s['id']; ?></td>
                        <td nowrap><?php echo $s['name']; ?></td>
                        <td><?php echo $s['address']; ?></td>
                        <td nowrap><?php echo $s['contact']; ?></td>
                        <td nowrap><?php echo $s['status']; ?></td>
                      </tr>
                      <?php } ?>
                  </table>
                </div>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
