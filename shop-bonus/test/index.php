<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");
?>
<?php
use Lab\Helpers\IblockHelpers as IH;
use Lab\Helpers\SaleHelpers as SH;
use Lab\Helpers\UsersHelpers as UH;

// Email текущего пользователя
$currEmail = UH::getCurrentUserEmail();
// Email  пользователя по его id
$userEmail = UH::getUserEmailByUserId(650);




// получаем сумму стоимости всех ордеров юзера по его id
echo 'цена всех неотмененных заказов - '. SH::getPriceOrdersByUserId(650).'<br>';
// получаем Итого баллов юзера по id
echo ' Сомов COLUMN33 -'. IH::getPropertyValueByElementCode($userEmail, 'COLUMN33').'<br>';
echo ' Сомов COLUMN34 -'. IH::getPropertyValueByElementCode($userEmail, 'COLUMN34');

?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>