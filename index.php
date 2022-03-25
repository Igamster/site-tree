<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="container">
        <div id="goods" class="column">
            Список объектов
        </div>
        <form action="" method="POST">
        <div onclick='tree_toggle(arguments[0])' style="width: 70%">
        <?php
        if (treeDB(0)) {
            tree(0);
        } else {
            echo"<ul class='Container' id='0'><li class='Node ExpandLeaf IsLast'><div class='Expand'></div><input type='radio' name='object' id='0' value='0' checked/>";
            echo "<div class='Input InputFolder Closed'></div><div class='Input InputNear NearOff'></div><div class='Content'>Объекты отсутствуют</div></li></ul>\n";
        }
        if (userAvthorizatoin()) {
            includeTemplate('button_a.php', ['name' => $_SESSION['Autorized']['name']]);
        }
        ?>
        </div>
        </form>
    </div>
</main>
<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>