<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 03</title>
</head>
<body>
    <div>
        <h3>Create</h3>
        <form action="<?= $app->getActionPath() ?>" method="post">
            <input type="hidden" name="action" value="create" />
            <input type="text" name="name" />
            <input type="text" name="surname" />
            <input type="Submit">
        </form>
    </div>
    <table>
        <thead>
            <th>ID</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Pilsēta</th>
            <th>Darbība</th>
        </thead>
        <tbody>
            <?php foreach($app->people() as $person) { ?>
            <tr>
                <td><?= $person['id'] ?></td>
                <td><?= $person['name'] ?></td>
                <td><?= $person['surname'] ?></td>
                <td><?= $person['city'] ?></td>
                <td>
                    <a href="?action=edit&id=<?= $person['id'] ?>">Rediģēt</a>
                    <form action="<?= $app->getActionPath() ?>" method="post">
                        <input type="hidden" name="action" value="delete" />
                        <input type="hidden" name="id" value="<?= $person['id'] ?>" />
                        <input type="Submit" value="Dzēst">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if ($app->showEditForm()) { ?>
    <div>
        <h3>Edit</h3>
        <form action="<?= $app->getActionPath() ?>" method="post">
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="id" value="<?= $editPerson['id'] ?>" />
            <input type="text" name="name" value="<?= $editPerson['name'] ?>" />
            <input type="text" name="surname" value="<?= $editPerson['surname'] ?>"/>
            <input type="text" name="city" value="<?= $editPerson['city'] ?>"/>
            <input type="Submit" value="Save">
        </form>
    </div>
    <?php } ?>
</body>
</html>