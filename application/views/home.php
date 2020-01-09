<?php
  
  if(isset($_SESSION['username'])){
    echo "<br><h3> Welcome " . strtoupper($user[0]->sz_username). " </h3>";
  }else
  {
     redirect(base_url().'Welcome','refresh');
  }
?>
<!doctype html>
<html lang="en">

  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right">
          <a href="<?php echo base_url(); ?>Welcome/logout" class="btn btn-dark">Log Out</a>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h4>Your Daily Records</h4>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-6 text-left">
                      <?php
                         $totalEntry=0;
                         $totalLateEntry=0;
                         $totalEarlyExit=0;
                         $totalExit=0;       
                        foreach($record as $datarecord)
                        {
                          if($datarecord->status==1)
                          {
                            if($datarecord->reason!=null)
                            {
                              $totalLateEntry++;
                            }
                            $totalEntry++;
                          }
                          else
                          {
                            if($datarecord->reason!=null)
                            {
                              $totalEarlyExit++;
                            }
                            $totalExit++;
                          }
                        }

                      echo "<span class='badge badge-success'> Total Entries = $totalEntry </span> <span class='badge badge-danger'>Late Entries = $totalLateEntry</span> ";
                      echo "<br><span class='badge badge-success'> Total Exits = $totalExit </span> <span class='badge badge-danger'>Early Exits = $totalEarlyExit</span> ";

                      ?>
                </div>
                <div class="col-md-6 text-right">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelId">
                    + Add New Entry
                  </button>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelId1">
                    + Add New Exit
                  </button>


                </div>
              </div>
              <br>
              <table id="example" class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>reason</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $i=1;
                      foreach($record as $recordRow){
                        ?>

                  <tr>
                    <td scope="row"><?= $i++ ?></td>
                    <td><?= date_format(date_create($recordRow->dt_date),'d-F-Y') ?></td>
                    <td><?= $recordRow->sz_time ?></td>
                    <td>
                      <?php if($recordRow->status==1) echo "<span class='font-weight-bold text-success'>Entry</span>"; else echo "<span class='font-weight-bold text-danger'>Exit</span>"; ?>
                    </td>
                    <td><?php if($recordRow->reason==null) echo "<span class='badge badge-success'>No Reason Avalible</span>"; else echo "<span class='badge badge-warning'>".$recordRow->reason."</span>" ?>
                    </td>
                    <td>
                        <a href="<?= base_url() ?>Welcome/DeleteRecord/<?= $recordRow->nm_recordid ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>

                  </tr>
                  <?php
                      }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <span class="">Copyright © 2020-2021  <a class='badge bage-secondary' target="_blank" href="https://jigarvakil.github.io/Online-timing-attendance/" > Daily Entrance/Exit v1.0 </a>  |
                All Rights Reserved </span>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= base_url() ?>Welcome/AddEntry" method="post">
            <div class="modal-header">
              <h5 class="modal-title">Add Entry Record</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Reason- (If you enter late in class)</label>
                      <textarea class="form-control" name="txtreason" id="txtreason" rows="3"></textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="modelId1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= base_url() ?>Welcome/AddExit" method="post">
            <div class="modal-header">
              <h5 class="modal-title">Add Exit Record</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Reason- (If you Leave class early)</label>
                      <textarea class="form-control" name="txtreason" id="txtreason" rows="3"></textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
      </div>
    </div>

    <script>
    $('#exampleModal').on('show.bs.modal', event => {
      var button = $(event.relatedTarget);
      var modal = $(this);
      // Use above variables to manipulate the DOM

    });
    </script>
    <script>


    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>



  </body>

</html>