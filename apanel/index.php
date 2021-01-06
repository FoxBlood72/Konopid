<?php 
require_once 'webparts/header.php';
?>
        <div class="page-title">
            <h3>Add Template Game Page</h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add Game</div>
                    <div class="card-body">
                        <h5 class="card-title">Create a template game by inputing the following informations.</h5>
                        <form accept-charset="utf-8">
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
                                    <input type="file" class="custom-file-input" id="customFile" name="filename">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit the game">
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
                                
                                <tr role="row" class="odd">
                                    <td class="dtr-control sorting_1" tabindex="0">Doris Greene</td>
                                    <td>ms.greene@outlook.com</td>
                                    <td>Writer</td>
                                    <td>Active</td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-outline-info btn-rounded"><i class="fas fa-pen"></i></a>
                                        <a href="" class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                
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

<?php

require_once('webparts/bottom.php');

?>