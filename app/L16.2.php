<?php
    // phpinfo();
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // $mysqli = new mysqli('localhost', 'user', 'secret', 'default');

    $db = new SQLite3('mysqlitedb.db');

    $db->exec("CREATE TABLE IF NOT EXISTS people (  
        id int NOT NULL PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        surname VARCHAR(255) NOT NULL,
        city VARCHAR(30)
    );");

    
    $result = $db->query('SELECT count(*) as count FROM people');
    $count = $result->fetchArray()['count'];

    $id = $count+1;

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'create') {
            if (!empty($_POST['name']) && !empty($_POST['surname'])) {
                $db->exec("INSERT INTO people (id, name, surname) VALUES ($id, '{$_POST['name']}', '{$_POST['surname']}')");
            }

        } elseif ($_POST['action'] == 'update') {
            if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
                $city = $_POST['city'] ?? '';

                $r = $db->exec("UPDATE people SET name = '{$_POST['name']}', surname = '{$_POST['surname']}', city = '$city' WHERE id = {$_POST['id']}");
            }
        } elseif ($_POST['action'] == 'delete') {
            if (!empty($_POST['id'])) {

                $r = $db->exec("DELETE FROM people WHERE id = {$_POST['id']}");
            }
        }
    }

    $result = $db->query('SELECT * FROM people');

    // Data for edit form
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $editResult = $db->query("SELECT * FROM people WHERE id=$id");

        $editPerson = $editResult->fetchArray();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 02</title>
</head>
<body>
    <?php 
        $filepatharray = explode('/', __FILE__);
        $submitPath = array_pop($filepatharray);
    ?>
    <div>
        <h3>Create</h3>
        <form action="/<?= $submitPath ?>" method="post">
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
            <?php 
                $person = $result->fetchArray();

                while($person) { ?>
            <tr>
                <td><?= $person['id'] ?></td>
                <td><?= $person['name'] ?></td>
                <td><?= $person['surname'] ?></td>
                <td><?= $person['city'] ?></td>
                <td>
                    <a href="?action=edit&id=<?= $person['id'] ?>">Rediģēt</a>
                    <form action="/<?= $submitPath ?>" method="post">
                        <input type="hidden" name="action" value="delete" />
                        <input type="hidden" name="id" value="<?= $person['id'] ?>" />
                        <input type="Submit" value="Dzēst">
                    </form>
                </td>
            </tr>
            <?php 
                $person = $result->fetchArray();
            } ?>
        </tbody>
    </table>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && $editPerson) { ?>
    <div>
        <h3>Edit</h3>
        <form action="/<?= $submitPath ?>" method="post">
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
<?php 

    // mysqli_close($mysqli);
?>