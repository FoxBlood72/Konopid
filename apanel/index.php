<?php 
require_once 'webparts/header.php';
?>
        <div class="page-title">
            <h3>Add Template Game Page</h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php 
                require_once 'utility/successadmin.php';
                ?>

                <div class="card">
                    <div class="card-header">Add Game</div>
                    <div class="card-body">
                        <h5 class="card-title">Create a template game by inputing the following informations.</h5>
                        <form accept-charset="utf-8" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="game">Game Name</label>
                                <input name="gamename" placeholder="Name of the game" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="description">Game description</label>
                                <textarea class="form-control" placeholder="Description of the game" name="descgame" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file_upload">Upload a front image. You can edit the image after you done the game</label>
                                <br>
                                <div class="custom-file mb-3" style="width:45%;">
                                    <input type="file" class="custom-file-input" id="customFile" name="fileg">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input name="submitg" type="submit" class="btn btn-primary" value="Submit the game">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title">
            List of the current game pages
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Games will show down here</div>
                    <div class="card-body">
                    <div class="box box-primary">
            
            
            
                    <div class="box-body">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row"><div class="col-sm-12"><table class="table table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 200px;" aria-label="Email: activate to sort column ascending">Game Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 250px;" aria-label="Role: activate to sort column ascending">Description</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 250px;" aria-label="Type: activate to sort column ascending">Photo path</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 50px;" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 87px;" aria-label=": activate to sort column ascending"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $rows = $admindb->getGames();
                                foreach($rows as $row)
                                {
                                ?>
                                <tr role="row" class="odd">
                                    <td class="dtr-control sorting_1" tabindex="0"><?php echo htmlspecialchars($row['gamename'], ENT_QUOTES, 'UTF-8');?></td>
                                    <td><?php if(strlen($row['description']) > 30) echo substr($row['description'], 0, 30) . '...'; else echo $row['description']?></td>
                                    <td><?php echo htmlspecialchars($row['url'], ENT_QUOTES, 'UTF-8');?></td>
                                    <td><?php echo htmlspecialchars($row['active'] ? "Active" : "Down", ENT_QUOTES, 'UTF-8');?></td>
                                    <td class="text-right">
                                        <a data-active="<?php echo htmlspecialchars($row['active'], ENT_QUOTES, 'UTF-8');?>" data-description="<?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8');?>" data-title="<?php echo htmlspecialchars($row['gamename'], ENT_QUOTES, 'UTF-8');?>" data-id="<?php echo htmlspecialchars($row['ID'], ENT_QUOTES, 'UTF-8');?>" data-toggle="modal" data-target="#editModal" class="openModalDialog btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                        <a href="?del=<?php echo $row['ID'] ?>" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                                
                            </tbody>
                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to 7 of 7 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTables-example_previous"><a href="#" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="dataTables-example_next"><a href="#" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                    </div>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit the game</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" method="post" disabled="">
        <div id="alertmsg" class="alert alert-danger" style="display:none;" role="alert">The game name already exists!</div>
        <div id="successmsg" class="alert alert-success" style="display:none;" role="alert">The game was updated</div>
           
            <div class="form-group">
                <label for="game">Game Name</label>
                <input id="titlegame" name="gamename" placeholder="Name of the game" class="form-control" required="">
            </div>
            <div class="form-group">
                <label for="description">Game description</label>
                <textarea id="gamedesc" class="form-control" placeholder="Description of the game" name="descgame" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="file_upload">Change active status</label>
                <br>
                <select id="activeform" class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">Down</option>
                </select>
            </div>
            <input id="gameId" type="hidden" name="gameid" value="">
            
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submitDialog" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on("click", ".openModalDialog", function () {
     var id = $(this).data('id');
     var description = $(this).data('description');
     var title = $(this).data('title');
     var active = $(this).data('active');
     $("#alertmsg").css('display', 'none');
     $("#successmsg").css('display', 'none');
     $("#titlegame").val( title );
     $("#gamedesc").val( description );
     $("#activeform").val( active );
     $("#gameId").val( id );
     
});

$(document).on("click", "#submitDialog", function() {
    $.post("ajax/modifygame.php", {
        gameId: $("#gameId").val(),
        titlegame: $("#titlegame").val(),
        gamedesc: $("#gamedesc").val(),
        activeform: $("#activeform").val()
    },
    function(data, status){
        if(data === '1')
        {
            $("#alertmsg").css('display', 'block');
            $("#successmsg").css('display', 'none');
        }
        else
        {
            $("#alertmsg").css('display', 'none');
            $("#successmsg").css('display', 'block');
        }

    });
});

</script>

<?php

require_once('webparts/bottom.php');

?>