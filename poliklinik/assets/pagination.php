<script src="bootstrap/js/jquery-3.1.0.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
   <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
<?php
include 'inc/connect.inc';
/**
 * [paging description]
 * @param  [type] $tabel       [description]
 * @param  [type] $dataPerPage [description]
 * @param  [type] $noPage      [description]
 * @param  [type] $link        [description]
 * @return [type]              [description]
 */
function paging ($tabel, $dataPerPage, $noPage, $link) {
    include 'inc/connect.inc';
    $sql = $db->query("SELECT COUNT(*) AS jumData FROM $tabel");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_LAZY);
    $jumData = $data->jumData;

    if ($dataPerPage == 1) {
        $dataPerPage = $jumData;
    }
    $jumPage = ceil($jumData/$dataPerPage);

    if ($noPage > 1) 
        echo "<a href='" . $link . "hal=" . ($noPage - 1) . "'>";?><li class="pagination">&laquo;</li></a>
        <?php
        for ($page=1; $page <= $jumPage; $page++) { 
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {
                if (($page == 1) && ($page != 2)) {
                    //terserahhhh
                }
                if (($page != ($jumPage - 1)) && ($page == $jumPage)){
                    //terserahhhh
                }

                if ($page == $noPage){
                ?>
                    <b><li><?php echo $page; ?></li></b>
                <?php
                }
                else {
                    ?>
                        <a href='<?php echo $link; ?>hal=<?php echo $page; ?>'><li><?php echo $page; ?></li></a>
                    <?php
                }
            $showPage = $page;
        }
    }
    if ($noPage<$jumPage){
    ?>
        <a href='<?php echo $link; ?>hal=<?php echo $noPage + 1; ?>'><li>&raquo;</li></a>
    <?php
    }
}
?>
