<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");
?>
<?php
use Lab\Helpers\SaleHelpers as SaleHelper;

$arQtty=SaleHelper::getCurrentUserRealQuantityBasketProduct();
pretty_print($arQtty);
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>