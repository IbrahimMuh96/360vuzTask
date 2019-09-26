<?php
session_start();
include_once 'functions/get_users.php';
include_once 'partials/header.php';
$page_title = 'Users';
?>
<?php if (isset($msg) ) : ?>
<div class="container">
    <div class="sa-success">
        <section>
            <div class="alert alert-success" role="alert">
                <?php echo $msg;?>
            </div>
        </section>
    </div>
</div>
<?php endif; ?>
<div class="container">
    <table class="table">
        <thead class="thead">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Joined Date</th>
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Deactivate</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $key=>$user) {
            if($user['active']){
                $status = '<td><span class="badge badge-success">Enabled</span></td>';
            } else {
                $status = '<td><span class="badge badge-danger">Disabled</span></td>';
            }
            if($user['active']){
                $action = '<td><a class="btn btn-outline-danger" style="display: initial !important;" href="users.php?deactivate='. $user['id'] .'" role="button">Disable</a></td>';
            } else {
                $action = '<td><a class="btn btn-outline-success" style="display: initial !important;" href="users.php?activate='. $user['id'] .'" role="button">Enable</a></td>';
            }
            echo '<tr>
                        <th scope="row">'. $user['id'] .'</th>
                        <td>'.$user['username'].'</td>
                        <td>'.$user['email'].'</td>
                        <td>'.$user['join_date'].'</td>
                        '.$status.'
                        <td><a class="btn btn-outline-primary" style="display: initial !important;" href="edit_user.php?id='. $user['id'] .'" role="button">Edit</a></td>
                        '.$action.'            
                 </tr>';
        }
        ?>
        </tbody>
    </table>
    <a href="create_user.php" class="btn btn-danger">Create User</a>

</div>

<?php
include_once 'partials/footer.php';
?>