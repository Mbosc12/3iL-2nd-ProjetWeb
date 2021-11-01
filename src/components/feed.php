<?php
    include '../requests/Model.php';

    $username = $_SESSION['pseudo'];

    $request = Model::getPostsFollowed($username);
    if (sizeof($request) === 0) {
        echo '<h1 id="m-feed-no-pub">Aucune publication</h1>';
    }
    foreach ($request as $req) {
        $id = $req->PK_post_id;
        $_GET['id'] = $id;
        include '../components/post.php';
    }
?>
<script type="text/javascript">
    let email = '<?php echo $_SESSION['mail']; ?>';
</script>

<div id="feed">
</div>