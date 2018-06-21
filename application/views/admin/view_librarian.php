<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Librarians
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()."Admin";?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>View</li>
      <li class="active">Librarians</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Librarian</h3>
                	<div class="box-tools">
                  </div>
                </div>
                <div class="box-body">
                  <div style="overflow-x:auto;">
                    <table class="table table-striped">
                        <tbody>
                          <tr>
                						<th>ID</th>
                						<th nowrap>School Id</th>
                						<th nowrap>First Name</th>
                						<th nowrap>Middle Name</th>
                						<th nowrap>Last Name</th>
                						<th nowrap>Status</th>
                          </tr>
                        </tbody>
                        <?php
                        $school = "";
                        foreach($users as $u){
                          if($school == "" || $school != $u["school"]){
                            echo "<tbody>
                                    <tr style = \"background-color:#a5cae4\"> <td colspan = '6'>";

                            foreach ($schools as $s) {
                              if($s["id"] == $u["school"]) {
                                echo $s["name"]." (".$s["id"].")";
                                break;
                              }
                            }
                            echo "</td> </tr>";
                          }
                        ?>
                        <tr>
              						<td><?php echo $u['id']; ?></td>
              						<td><?php echo $u['schoolId']; ?></td>
              						<td nowrap><?php echo $u['firstName']; ?></td>
              						<td nowrap><?php echo $u['middleName']; ?></td>
              						<td nowrap><?php echo $u['lastName']; ?></td>
              						<td nowrap><?php echo $u['status']; ?></td>
                        </tr>
                      <?php
                            if($school == "" || $school != $u["school"]){
                              $school = $u["school"];
                              echo "</tbody>";
                            }
                          } ?>
                    </table>
                  </div>
                    <div class="pull-right">
                        <?php print_r( $this->pagination->create_links()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
