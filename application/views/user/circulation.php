<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      List of Books
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>View</li>
      <li class="active">Books</li>
    </ol>
  </section>
    <div class="row">
      <div class="col-md-12">
        <div class="box" style="margin-top: 10px;">
            <div class="box-header">
                <h3 class="box-title">Books </h3>
            </div>
            <div class="box-body">
              <div style="overflow-x:auto;">
                <table class="table table-striped">
                    <tr>
                      <th nowrap>ID</th>
                      <th nowrap>ISBN</th>
                      <th nowrap>Category</th>
                      <th nowrap>Section</th>
                      <th nowrap>Title</th>
                      <th>Stocks</th>
                      <th nowrap>Price</th>
                      <th>Author</th>
                      <th>Editor</th>
                    </tr>
                    <?php foreach($books as $b){ ?>
                      <tr>
                        <td nowrap><?php echo $b['id']; ?></td>
                        <td nowrap><?php echo $b['ISBN']; ?></td>
                        <td nowrap><?php echo $b['category']; ?></td>
                        <td nowrap><?php echo $b['section']; ?></td>
                        <td nowrap><?php echo $b['title']; ?></td>
                        <td><?php echo $b['stocks']; ?></td>
                        <td nowrap><?php echo $b['price']; ?></td>
                        <td><?php echo $b['author']; ?></td>
                        <td><?php echo $b['editor']; ?></td>
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
  </div>
  <!-- Main content -->
  <section class="content">
  </section>
</div>