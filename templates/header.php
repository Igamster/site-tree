<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
if (!empty($_POST['submit'])) {
    session_destroy();
    header('Location: /');
}
if (!empty($_POST['edit'])) {
    $connect = connectDB();
    switch ($_POST['edit']) {
        case 'add':
            mysqli_query($connect, "INSERT INTO object (id, name, description, id_parent) VALUES (NULL, '".$_POST['name']."', '".$_POST['descr']."', ".$_POST['object'].")");
            break;
        case 'edit':
            mysqli_query($connect, "UPDATE object SET name='".$_POST['name']."',description='".$_POST['descr']."' WHERE id=".$_POST['object']);
            break;
        case 'delete':
            mysqli_query($connect, "DELETE FROM object WHERE id = ".$_POST['object']);
            mysqli_query($connect, "DELETE FROM object WHERE id_parent = ".$_POST['object']);
            break;
    }
    header('Location: /');
}
?>
<!doctype html>
<html class="antialiased" lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Дерево объектов</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/assets/css/form.min.css" rel="stylesheet">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-600 font-sans leading-normal text-base tracking-normal flex min-h-screen flex-col">
<div class="wrapper flex flex-1 flex-col bg-gray-100">
    <header class="bg-white">
        <div class="border-b">
            <div class="container mx-auto block overflow-hidden px-4 sm:px-6 sm:flex sm:justify-between sm:items-center py-4 space-y-4 sm:space-y-0">
                <div class="flex justify-center">
                    <a href="/" class="inline-block sm:inline hover:opacity-75">
                        <img src="/assets/images/logo.png" width="150" height="60" alt="">
                    </a>
                </div>
                <div>
                    <?php
                    if (userAvthorizatoin()) {
                        includeTemplate('Authorized.php', ['name' => $_SESSION['Autorized']['name']]);
                    } else {
                        includeTemplate('notAuthorized.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>