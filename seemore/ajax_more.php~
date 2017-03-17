<?php
if(isset($_GET["id"]) && !empty($_GET["id"])){

//include database configuration file
include('db_config.php');

//count all rows except already displayed
$queryAll = mysqli_query($con,"SELECT COUNT(*) as num_rows FROM tutorials WHERE id < ".$_GET['id']." ORDER BY id DESC");
$row = mysqli_fetch_assoc($queryAll);
$allRows = $row['num_rows'];

if(isset($_GET["showlimit"]) && !empty($_GET["showlimit"])){
$showLimit = $_GET["showlimit"];
}

//get rows query
$query = mysqli_query($con, "SELECT * FROM tutorials WHERE id < ".$_GET['id']." ORDER BY id DESC LIMIT ".$showLimit);

//number of rows
$rowCount = mysqli_num_rows($query);

if($rowCount > 0){ 
    while($row = mysqli_fetch_assoc($query)){ 
        $tutorial_id = $row["id"]; ?>
        <div class="list_item"><a href="javascript:void(0);"><h2><?php echo $row["title"]; ?></h2></a></div>
<?php } ?>
<?php if($allRows > $showLimit){ ?>
    <div class="show_more_main" id="show_more_main<?php echo $tutorial_id; ?>">
        <span id="<?php echo $tutorial_id; ?>" class="show_more" title="Load more posts">Show more</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading…</span></span>
    </div>
<?php } ?>  
<?php 
    } 
}
?>
