<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
if (userAvthorizatoin()) {
    header('Location: /');
}
$success_Autorized = false;
$error_Autorized = false;
$flag_activ = false;
if (!empty($_POST)) {
    $connect = connectDB();
    $email_post = mysqli_real_escape_string($connect, $_POST['email']);
    $user = mysqli_fetch_assoc(mysqli_query($connect, 'SELECT id, user_name, password  FROM users WHERE user_name="' . $email_post . '" LIMIT 1'));
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $success_Autorized = true;
        $_SESSION['Autorized'] = ['authorization' => true, 'name' => $user['user_name'], 'id' => $user['id']];
        setcookie("Email_User", $_POST['email'], time() + 60 * 60 * 24 * 30, '/');
        header('Refresh: 2; /');
    } else {
        $error_Autorized = true;
    }
}
?>
<main class="flex-1 container mx-auto bg-white overflow-hidden px-4 sm:px-6">
    <div class="py-4 pb-8">
        <h1 class="text-black text-3xl font-bold mb-4">Авторизация</h1>
        <?php
        if ($success_Autorized) {
            includeTemplate('messages/success_message.php', ['message' => 'Вы успешно авторизовались']);
        } elseif ($error_Autorized) {
            includeTemplate('messages/error_message.php', ['message' => 'Неверно указан логин или пароль']);
        }
        if (!$success_Autorized) {?>
        <form action="/login/" method="POST" >
            <div class="mt-8 max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <div class="block">
                        <label for="fieldEmail" class="text-gray-700 font-bold">Login</label>
                        <input id="fieldEmail" name="email" value="<?=($_POST['email'] ?? $_COOKIE['Email_User'] ?? '')?>" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="ivan-ivanov@mail.ru">
                    </div>
                    <div class="block">
                        <label for="fieldPassword" class="text-gray-700 font-bold">Пароль</label>
                        <input id="fieldPassword" name="password" value="<?=($_POST['password'] ?? '')?>" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="************">
                    </div>
                    <div class="block">
                        <button type="submit" name="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Войти
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <?php }?>
    </div>
</main>
<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>