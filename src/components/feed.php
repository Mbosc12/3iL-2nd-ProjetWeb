<?php
    include '../requests/Model.php';

    $username = $_SESSION['pseudo'];

    $request = Model::getPostsFollowed($username);
    foreach($request as $req) {
        $id = $req->PK_post_id;
        $_GET['id']=$id;
        include '../components/post.php';
    }

?>
<script type="text/javascript">
    var username = '<?php echo $_SESSION['pseudo']; ?>'
</script>

<div id="feed">
</div>