<?php 
$link=mysqli_connect("localhost","root","","tpu") or die("error connect");
if (isset($_POST['blok'])) {
    $query = mysqli_query($link,"SELECT * FROM subblok WHERE idblok = ".$_POST['blok']."");
    $result = array();
    while ($res=mysqli_fetch_assoc($query)) {
    $result[] = array('value' => $res['idsubblok'],
             'name' => $res['subblok']
         );
    }
    echo json_encode($result);
}
 ?>