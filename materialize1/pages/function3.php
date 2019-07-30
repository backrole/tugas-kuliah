<script src="js/jquery.js"></script>
  <script src="js/materialize.js"></script>
  <link rel="stylesheet" href="css/materialize.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
include 'inc/koneksi.php';
/**
 * [paging description]
 * @param  [type] $tabel       [description]
 * @param  [type] $dataPerPage [description]
 * @param  [type] $noPage      [description]
 * @param  [type] $link        [description]
 * @return [type]              [description]
 */
function paging ($tabel, $dataPerPage, $noPage, $link) {
    include 'inc/koneksi.php';
    $sql = $db->query("SELECT COUNT(*) AS jumData FROM $tabel");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_LAZY);
    $jumData = $data->jumData;

    if ($dataPerPage == 1) {
        $dataPerPage = $jumData;
    }
    $jumPage = ceil($jumData/$dataPerPage);

    if ($noPage > 1) 
        echo "<a href='" . $link . "hal=" . ($noPage - 1) . "'>";?><li><i class="material-icons blue-text">chevron_left</i></li></a>
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
                    <b><li class="active white-text"><?php echo $page; ?></li></b>
                <?php
                }
                else {
                    ?>
                        <a href='<?php echo $link; ?>hal=<?php echo $page; ?>'><li class="waves-effect"><?php echo $page; ?></li></a>
                    <?php
                }
            $showPage = $page;
        }
    }
    if ($noPage<$jumPage){
    ?>
        <a href='<?php echo $link; ?>hal=<?php echo $noPage + 1; ?>'><li><i class="material-icons">chevron_right</i></li></a>
    <?php
    }
}
?>
