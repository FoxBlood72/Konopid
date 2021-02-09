<?php 
require_once 'database/user.php';
$COLUMS = 3;


$rows = $userdb->getGames();
$rowscount = $rows->rowCount();
$percolumn = intdiv($rowscount, $COLUMS);
$reminder = $rowscount % $COLUMS;
?>
<div class="rowgrid">

    <?php 
    for($i = 1; $i<=$COLUMS; $i++)
    {
    ?>
        <div class="columngrid">
            <?php 
            $reminder_plus_check = true;
            $reminder_plus = 0;

            for($j = 1; $j <= $percolumn + $reminder_plus; $j++)
            {
                $row = $rows->fetch(PDO::FETCH_ASSOC);
                if($row)
                {
                ?>
                    <div class="imgcontainer">
                        <img class="timage" src="images/games/<?php echo htmlspecialchars($row['url'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="middle">
                            <div class="ttext"><?php echo htmlspecialchars($row['gamename'], ENT_QUOTES, 'UTF-8');?></div>
                        </div>
                    </div>
                <?php 
                }
                if($reminder !== 0 && $reminder_plus_check)
                {
                    $reminder_plus += 1;
                    $reminder -= 1;
                    $reminder_plus_check = false;
                }
                

            }
            ?>

        </div>
    <?php 
    }
    ?>
</div>