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


<td><?= ++$i ?></td>
<td><input type="text" name="name" value="<?= $name ?>" placeholder="Название тендера" class="form-control"></td>
<td><?= $date ?></td>
<td><textarea name="code" placeholder="Код тендера" class="form-control"><?= $code ?></textarea></td>
<td><?= $year ?></td>
<td>
    <button class="update-tender-submit btn btn-primary">Изменить</button>
    <br>
    <button class="delete-tender-submit btn btn-danger">Удалить</button>
</td>
