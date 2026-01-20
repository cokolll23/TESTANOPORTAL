<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @global CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */

/** @var string $templateFolder */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

if ($arParams['GUEST_MODE'] !== 'Y') {
    Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
    Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
}
CJSCore::Init(array('clipboard', 'fx'));

$APPLICATION->SetTitle("");

if (!empty($arResult['ERRORS']['FATAL'])) {
    $component = $this->__component;
    foreach ($arResult['ERRORS']['FATAL'] as $code => $error) {
        if ($code !== $component::E_NOT_AUTHORIZED)
            ShowError($error);
    }

    if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
        ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="alert alert-danger"><?= $arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED] ?></div>
            </div>
            <?php
            $authListGetParams = array();
            ?>
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <?php
                $APPLICATION->AuthForm('', false, false, 'N', false);
                ?>
            </div>
        </div>
        <?php
    }
} else {
    if (!empty($arResult['ERRORS']['NONFATAL'])) {
        foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
            ShowError($error);
        }
    }
    ?>
    <div class="container sale-order-detail">
        <div class="col">

            <h1 class="mb-3">
                <?= Loc::getMessage('SPOD_LIST_MY_ORDER', array(
                        '#ACCOUNT_NUMBER#' => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
                        '#DATE_ORDER_CREATE#' => $arResult["DATE_INSERT_FORMATED"]
                )) ?>
            </h1>

            <?php
            if ($arParams['GUEST_MODE'] !== 'Y') {
                ?>
                <div class="mb-3">
                    <a href="<?= htmlspecialcharsbx($arResult["URL_TO_LIST"]) ?>">&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS') ?></a>
                </div>
                <?php
            }
            ?>

            <div class="row mb-3 mx-0">
                <div class="col sale-order-detail-card">

                    <h2 class="sale-order-detail-card-title">
                        <?= Loc::getMessage('SPOD_SUB_ORDER_TITLE', array(
                                "#ACCOUNT_NUMBER#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
                                "#DATE_ORDER_CREATE#" => $arResult["DATE_INSERT_FORMATED"]
                        )) ?>
                        <?= count($arResult['BASKET']); ?>
                        <?php
                        $count = count($arResult['BASKET']) % 10;
                        if ($count === 1) {
                            echo Loc::getMessage('SPOD_TPL_GOOD');
                        } elseif ($count >= 2 && $count <= 4) {
                            echo Loc::getMessage('SPOD_TPL_TWO_GOODS');
                        } else {
                            echo Loc::getMessage('SPOD_TPL_GOODS');
                        }
                        ?>
                        <?= Loc::getMessage('SPOD_TPL_SUMOF') ?>
                        <?= $arResult["PRICE_FORMATED"] ?>
                    </h2>

                    <div class="row mb-3">
                        <div class="col p-0">
                            <h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_LIST_ORDER_INFO') ?></h3>
                            <div class="row m-0">
                                <div class="col-sm mb-3">
                                    <div class="sale-order-detail-prop-name">
                                        <?php
                                        $userName = $arResult["USER_NAME"];
                                        if ($userName <> '' || $arResult['FIO'] <> '') {
                                            echo Loc::getMessage('SPOD_LIST_FIO') . ':';
                                        } else {
                                            echo Loc::getMessage('SPOD_LOGIN') . ':';
                                        }
                                        ?>
                                    </div>
                                    <div class="sale-order-detail-prop-value">
                                        <?php
                                        if ($userName <> '') {
                                            echo htmlspecialcharsbx($userName);
                                        } elseif (mb_strlen($arResult['FIO'])) {
                                            echo htmlspecialcharsbx($arResult['FIO']);
                                        } else {
                                            echo htmlspecialcharsbx($arResult["USER"]['LOGIN']);
                                        }
                                        ?>
                                    </div>
                                    <div class="pt-3">
                                        <a href="" onclick="return false;"
                                           class="sale-order-detail-more-info-less"><?= Loc::getMessage('SPOD_LIST_LESS') ?></a>
                                        <a href="" onclick="return false;"
                                           class="sale-order-detail-more-info-more"><?= Loc::getMessage('SPOD_LIST_MORE') ?></a>
                                    </div>
                                </div>

                                <div class="col-sm-auto mb-3">
                                    <div class="sale-order-detail-prop-name">
                                        <?= Loc::getMessage('SPOD_LIST_CURRENT_STATUS_DATE', array(
                                                '#DATE_STATUS#' => $arResult["DATE_STATUS_FORMATED"]
                                        )) ?>
                                    </div>
                                    <div class="sale-order-detail-prop-value">
                                        <?php
                                        if ($arResult['CANCELED'] !== 'Y') {
                                            echo htmlspecialcharsbx($arResult["STATUS"]["NAME"]);
                                        } else {
                                            echo Loc::getMessage('SPOD_ORDER_CANCELED');
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-sm mb-3">
                                    <div class="sale-order-detail-prop-name"><?= Loc::getMessage('SPOD_ORDER_PRICE') ?>
                                        :
                                    </div>
                                    <div class="sale-order-detail-prop-value"><?= $arResult["PRICE_FORMATED"] ?></div>
                                </div>

                                <?php
                                if ($arParams['GUEST_MODE'] !== 'Y') {
                                    ?>
                                    <div class="col-sm-auto mb-3 text-center">
                                        <a href="<?= $arResult["URL_TO_COPY"] ?>"
                                           class="btn btn-primary btn-block btn-sm my-1"><?= Loc::getMessage('SPOD_ORDER_REPEAT') ?></a>
                                        <?php
                                        if ($arResult["CAN_CANCEL"] === "Y") {
                                            ?>
                                            <a href="<?= $arResult["URL_TO_CANCEL"] ?>"
                                               class="btn btn-link btn-sm my-1"><?= Loc::getMessage('SPOD_ORDER_CANCEL') ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="row m-0 sale-order-detail-more-info-details" style="display: none;">
                                <div class="col">
                                    <h4 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_USER_INFORMATION') ?></h4>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-3 sale-order-detail-more-info-details-table">
                                            <?php
                                            if (mb_strlen($arResult["USER"]["LOGIN"]) && !in_array("LOGIN", $arParams['HIDE_USER_INFO'])) {
                                                ?>
                                                <tr>
                                                    <th><?= Loc::getMessage('SPOD_LOGIN') ?>:</th>
                                                    <td><?= htmlspecialcharsbx($arResult["USER"]["LOGIN"]) ?></td>
                                                </tr>
                                                <?php
                                            }
                                            if (mb_strlen($arResult["USER"]["EMAIL"]) && !in_array("EMAIL", $arParams['HIDE_USER_INFO'])) {
                                                ?>
                                                <tr>
                                                    <th><?= Loc::getMessage('SPOD_EMAIL') ?>:</th>
                                                    <td>
                                                        <a class=""
                                                           href="mailto:<?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?>"><?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            if (mb_strlen($arResult["USER"]["PERSON_TYPE_NAME"]) && !in_array("PERSON_TYPE_NAME", $arParams['HIDE_USER_INFO'])) {
                                                ?>
                                                <tr>
                                                    <th><?= Loc::getMessage('SPOD_PERSON_TYPE_NAME') ?>:</th>
                                                    <td><?= htmlspecialcharsbx($arResult["USER"]["PERSON_TYPE_NAME"]) ?></td>
                                                </tr>
                                                <?php
                                            }
                                            if (isset($arResult["ORDER_PROPS"])) {
                                                foreach ($arResult["ORDER_PROPS"] as $property) {
                                                    ?>
                                                    <tr>
                                                        <th><?= htmlspecialcharsbx($property['NAME']) ?>:</th>
                                                        <td><?php
                                                            if ($property["TYPE"] == "Y/N") {
                                                                echo Loc::getMessage('SPOD_' . ($property["VALUE"] == "Y" ? 'YES' : 'NO'));
                                                            } else {
                                                                if ($property['MULTIPLE'] == 'Y'
                                                                        && $property['TYPE'] !== 'FILE'
                                                                        && $property['TYPE'] !== 'LOCATION') {
                                                                    $propertyList = unserialize($property["VALUE"], ['allowed_classes' => false]);
                                                                    foreach ($propertyList as $propertyElement) {
                                                                        echo $propertyElement . '</br>';
                                                                    }
                                                                } elseif ($property['TYPE'] == 'FILE') {
                                                                    echo $property["VALUE"];
                                                                } else {
                                                                    echo htmlspecialcharsbx($property["VALUE"]);
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($arResult["USER_DESCRIPTION"] <> '') {
                        ?>
                        <div class="row mb-3">
                            <div class="col p-0">
                                <h4 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_DESC') ?></h4>
                                <p class="col sale-order-detail-section-comments"><?= nl2br(htmlspecialcharsbx($arResult["USER_DESCRIPTION"])) ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col p-0">
                            <h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_BASKET') ?></h3>

                            <div class="row mx-0">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"><?= Loc::getMessage('SPOD_NAME') ?></th>
                                                <th scope="col"><?= Loc::getMessage('SPOD_PRICE') ?></th>
                                                <?php
                                                if ($arResult["SHOW_DISCOUNT_TAB"] <> '') {
                                                    ?>
                                                    <th scope="col"><?= Loc::getMessage('SPOD_DISCOUNT') ?></th>
                                                    <?php
                                                }
                                                ?>
                                                <th scope="col"><?= Loc::getMessage('SPOD_QUANTITY') ?></th>
                                                <th class="text-right"><?= Loc::getMessage('SPOD_ORDER_PRICE') ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($arResult['BASKET'] as $basketItem) {
                                                ?>
                                                <tr>
                                                    <td class="sale-order-detail-order-item-img-block">
                                                        <a href="<?= $basketItem['DETAIL_PAGE_URL'] ?>">
                                                            <?php
                                                            if (is_array($basketItem['PICTURE'])) {
                                                                $imageSrc = $basketItem['PICTURE']['SRC'];
                                                            } else {
                                                                $imageSrc = $this->GetFolder() . '/images/no_photo.png';
                                                            }
                                                            ?>
                                                            <div class="sale-order-detail-order-item-img-container"
                                                                 style="background-image: url(<?= $imageSrc ?>);"></div>
                                                        </a>
                                                    </td>
                                                    <td class="sale-order-detail-order-item-properties"
                                                        style="min-width: 250px;">
                                                        <a class="sale-order-detail-order-item-title"
                                                           href="<?= $basketItem['DETAIL_PAGE_URL'] ?>"><?= htmlspecialcharsbx($basketItem['NAME']) ?></a>
                                                        <?php
                                                        if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS'])) {
                                                            foreach ($basketItem['PROPS'] as $itemProps) {
                                                                ?>
                                                                <div class="sale-order-detail-order-item-properties-type"><?= htmlspecialcharsbx($itemProps['VALUE']) ?></div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="sale-order-detail-order-item-properties">
                                                        <span class="bx-price"><?= $basketItem['BASE_PRICE_FORMATED'] ?></span>
                                                    </td>
                                                    <?php
                                                    if ($basketItem["DISCOUNT_PRICE_PERCENT_FORMATED"] <> '') {
                                                        ?>
                                                        <td class="sale-order-detail-order-item-properties text-right">
                                                            <?= $basketItem['DISCOUNT_PRICE_PERCENT_FORMATED'] ?>
                                                        </td>
                                                        <?php
                                                    } elseif (mb_strlen($arResult["SHOW_DISCOUNT_TAB"])) {
                                                        ?>
                                                        <td class="sale-order-detail-order-item-properties text-right">
                                                            <strong class="bx-price"></strong>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td class="sale-order-detail-order-item-properties">
                                                        <?= $basketItem['QUANTITY'] ?>&nbsp;
                                                        <?php
                                                        if ($basketItem['MEASURE_NAME'] <> '') {
                                                            echo htmlspecialcharsbx($basketItem['MEASURE_NAME']);
                                                        } else {
                                                            echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="sale-order-detail-order-item-properties text-right">
                                                        <strong class="bx-price"><?= $basketItem['FORMATED_SUM'] ?></strong>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row sale-order-detail-total-payment">
                        <div class="col sale-order-detail-total-payment-container">
                            <div class="row">
                                <ul class="col-md-8 col sale-order-detail-total-payment-list-left">
                                    <?php
                                    if (floatval($arResult["ORDER_WEIGHT"])) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_TOTAL_WEIGHT') ?>
                                        :</li><?php
                                    }

                                    if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED'])) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_COMMON_SUM') ?>
                                        :</li><?php
                                    }

                                    if ($arResult["PRICE_DELIVERY_FORMATED"] <> '') {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_DELIVERY') ?>
                                            :
                                        </li>
                                        <?php
                                    }

                                    if ((float)$arResult["TAX_VALUE"] > 0) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_TAX') ?>
                                            :
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_SUMMARY') ?>
                                        :
                                    </li>
                                </ul>
                                <ul class="col-md-4 col sale-order-detail-total-payment-list-right">
                                    <?php
                                    if (floatval($arResult["ORDER_WEIGHT"])) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['ORDER_WEIGHT_FORMATED'] ?></li><?php
                                    }

                                    if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED'])) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['PRODUCT_SUM_FORMATED'] ?></li><?php
                                    }

                                    if ($arResult["PRICE_DELIVERY_FORMATED"] <> '') {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["PRICE_DELIVERY_FORMATED"] ?></li>
                                        <?php
                                    }

                                    if ((float)$arResult["TAX_VALUE"] > 0) {
                                        ?>
                                        <li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["TAX_VALUE_FORMATED"] ?></li><?php
                                    }
                                    ?>
                                    <li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['PRICE_FORMATED'] ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--sale-order-detail-general-->
            </div>

            <?php
            if ($arParams['GUEST_MODE'] !== 'Y' && $arResult['LOCK_CHANGE_PAYSYSTEM'] !== 'Y') {
                ?>
                <div class="row mb-3">
                    <div class="col">
                        <a href="<?= $arResult["URL_TO_LIST"] ?>">&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS') ?></a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    $javascriptParams = array(
            "url" => CUtil::JSEscape($this->__component->GetPath() . '/ajax.php'),
            "templateFolder" => CUtil::JSEscape($templateFolder),
            "templateName" => $this->__component->GetTemplateName(),
            "paymentList" => $paymentData,
            "returnUrl" => $arResult['RETURN_URL'],
    );
    $javascriptParams = CUtil::PhpToJSObject($javascriptParams);
    ?>
    <script>
        BX.Sale.PersonalOrderComponent.PersonalOrderDetail.init(<?=$javascriptParams?>);
    </script>
    <?php
}
