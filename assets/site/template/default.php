<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include 'assets/site/inc/header.php'; ?>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><h4>Cidade</h4></th>
        </tr>
    </thead>
    <tbody>


        <?php
        foreach ($_cidades as $_cidade):
            ?>
            <tr>
                <td><?= $_cidade; ?></td>
            </tr>
            <?php
        endforeach;
        ?>

    </tbody>
</table>


<?php include 'assets/site/inc/footer.php'; ?>        