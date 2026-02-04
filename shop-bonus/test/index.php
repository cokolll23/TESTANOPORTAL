<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");
?>
<?

use Lab\Helpers\UserRegistrationService;

$filePath = '/shop-bonus/test/muf_bally.json';
$arUsersNew = Lab\Helpers\CommonHelpers::getRemakedArray($filePath );

foreach ($arUsersNew as $keyEmail => $arUser)
{
    $arFioExpl=explode(' ',$arUser['fio'] );
    $usersToRegister[$keyEmail]['EMAIL'] = $keyEmail;
    $usersToRegister[$keyEmail]['PASSWORD'] = $keyEmail;
    $usersToRegister[$keyEmail]['LAST_NAME'] = $arFioExpl[0];
    $usersToRegister[$keyEmail]['NAME'] = $arFioExpl[1];
    $usersToRegister[$keyEmail]['SECOND_NAME'] = $arFioExpl[2];
    $usersToRegister[$keyEmail]['GROUP_ID'] = [3,4,24];

}
pretty_print($usersToRegister,'MUF');

$result = UserRegistrationService::registerUsers($usersToRegister);
?>
<?php // Вывод результатов
echo "Статистика:\n";
echo "Всего пользователей: " . $result['summary']['total'] . "<br>";
echo "Успешно зарегистрировано: " . $result['summary']['success'] . "<br>";
echo "Не зарегистрировано: " . $result['summary']['failed'] . "<br><br><br><br>";

echo "<hr><h5><b>Зарегистрированные пользователи:</b></h5><br>";
foreach ($result['registered'] as $user) {
    echo "- ID: {$user['id']}, Email: {$user['email']}<br>";
}

echo "<hr><br><h5><b>Не зарегистрированные пользователи:</b><h5><br>";
foreach ($result['not_registered'] as $user) {
    echo "- Email: " . ($user['data']['EMAIL'] ?? 'N/A') . ", Причина: {$user['reason']}<br><br>";
}

echo "<hr><br><h5><b>Ошибки:</b><h5><br>";
foreach ($result['errors'] as $error) {
    echo "- Email: {$error['email']}, Ошибка: {$error['message']}<br>";
}
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>