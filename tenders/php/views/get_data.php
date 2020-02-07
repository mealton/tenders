<?php

/**
 * @var $id int
 * @var $i int
 * @var $name string
 * @var $date string
 * @var $code string
 * @var $year string
 */
?>

<tr id="<?= $id ?>">
    <td><?= ++$i ?></td>
    <td><?= $name ?></td>
    <td><?= $date ?></td>
    <td><?= $code ?></td>
    <td><?= $year ?></td>
    <td>
        <button class="update-tender btn btn-primary">Изменить</button>
    </td>
</tr>