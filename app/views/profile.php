<?php require_once 'header.html'; ?>
<div class="row">
    <div class="col-12">
        <h2 class="text-center mb-5">Profile</h2>
    </div>

    <div class="col-12">
        <table class="table table-bordered table-hover">
            <?php
                foreach ( $data as $k => $v ){
                    echo '<tr>';
                    echo '<td class="font-weight-bold">'.$k.'</td>';
                    echo '<td>'.$v.'</td>';
                    //echo '<td><a class="btn btn-primary" href="/edit/'. $data['ID'] .'">Edit</a></td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <p class="text-right">
            <a class="btn btn-secondary" href="/logout">Logout</a>
        </p>

    </div>

</div>
<?php require_once 'footer.html'; ?>
