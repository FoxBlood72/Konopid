<?php 

require_once 'webparts/header.php';
require_once 'p_req/chpw.php';

?>

<div class="page-title">
            <h3>Admin settings panel</h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php 
                if(isset($err) && $err === true)
                {
                ?>
                    <div class="alert alert-danger" role="alert">Invalid password! Please input your corect password</div>
                <?php 
                }
                else
                if(isset($err) && $err === true)
                {
                    ?>
                    <div class="alert alert-success" role="alert">Invalid password! Please input your corect password</div>
                    <?php
                }
                ?>
                <div class="card">
                
                    <div class="card-header">Change password</div>
                    <div class="card-body">
                        <form accept-charset="utf-8" method="post">
                            <div class="form-group">
                                <label for="game">Current password</label>
                                <input type="password" name="cpwd" style="width:35%;"  placeholder="Your current password" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="game">New password</label>
                                <input id="pwd" onkeyup="pwdch()" style="width:35%;"  type="password" name="npwd" placeholder="Your new password" class="form-control" required="">
                            </div>
                            
                            <div class="form-group">
                                <label for="game">Repeat password</label>
                                <br>
                                <input id="repwd" onkeyup="pwdch()" style="width:35%;float:left; margin-right:10px;" type="password" name="rpwd" placeholder="Repeat your password" class="form-control" required=""><span id="checksp" class="fas fa-check" style="font-size:25px;color:forestgreen;margin-top:1%;display:none;"></span><br><br>
                            </div>

                            <div class="form-group">
                                <input id="subbt" disabled="" type="submit" class="btn btn-primary" value="Change">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function pwdch()
        {
            if($("#repwd").val() === $("#pwd").val() && $("#pwd").val() !== "")
            {
                $("#checksp").show();
                $('#subbt').prop('disabled', false);
            }
            else
            {
                $("#checksp").hide();
                $('#subbt').prop('disabled', true);
            }
        }
        </script>
        
<?php 

require_once 'webparts/bottom.php';

?>