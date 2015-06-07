<?php
//A1 - pouzijeme prepared statements
//uplne najlepsie http://php.net/manual/en/mysqli-stmt.get-result.php
//pripadne treba pozriet na real_escape_string() a whitelistovat vyhladavanie teda povolit len znaky a cisla napriklad regexom ;)
$stmt = $db->stmt_init();
$sql = "SELECT id,title FROM articles WHERE title LIKE ? OR content LIKE ?";

$stmt = $db->prepare($sql);
if (  false === $stmt  ) {
    die('prepare() failed: ' . htmlspecialchars($db->error));
}

$rc = $stmt->bind_param("ss",$srch,$srch);
if ( false===$rc ) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

$srch = isset($_POST[search]) ? "%{$_POST[search]}%" : '';
$rc = $stmt->execute();
if ( false===$rc ) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

?>

<div>
    <?php
    //A3 - pri prepared statments je to uz brane ako string no pre istotu pouzit htmlspecialchars();
    $result = htmlspecialchars($_POST["search"]);
    echo '<h1> Výsledky vyhľadavania:'.$result.'</h1>';
    $stmt->bind_result($id, $title);
    while($stmt->fetch()){
        echo 'Article: <a href="./index.php?id='.htmlspecialchars($id).'">'.htmlspecialchars($title).'</a><br />';
    }
    ?>
</div>