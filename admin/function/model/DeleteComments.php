<?php 
require('../../src/database2.php');
if(isset($_GET['id_comments']) && !empty($_GET['id_comments'])){
    $IdComments = $_GET['id_comments'];

    $DeleComments = $bdd->prepare("SELECT * FROM comments WHERE id_comments = ?");
    $DeleComments->execute(array($IdComments));

    if($DeleComments->rowCount() > 0){

        $delete = $DeleComments->fetch(PDO::FETCH_ASSOC);
    

            $DeleC = $bdd->prepare("DELETE FROM comments WHERE id_comments = ?");
            $DeleC->execute(array($IdComments));

            header("location:../../../Params.php");
    }else{
        $errorMsg = 'Aucun commentaire trouvé!';
    }
}else{
    $errorMsg = 'Aucun id ne correspond au commentaire!';
}
?>