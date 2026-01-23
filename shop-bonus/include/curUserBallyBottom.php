<div class="row">
    <div class="col-md-6 interlab-form interlab-form-write2admin">
        <? $APPLICATION->IncludeComponent(
                "interlabs:feedbackform",
                "",
                array(
                        "AGREE_PROCESSING" => "N",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "EMAIL_FROM" => "sale@sokolru.ru",
                        "EMAIL_TO" => "cavjob@yandex.ru",
                        "EVENT_TYPE" => "INTERLABS_FEEDBACK",
                        "FIELD_CHECK" => array("NAME", "PHONE", "EMAIL", ""),
                        "FORM_ID" => "i_1",
                        "IBLOCK_FIELDS_USE" => array("NAME", "PHONE", "EMAIL", "MESSAGE"),
                        "IBLOCK_FIELD_EMAIL" => "EMAIL",
                        "IBLOCK_FIELD_PHONE" => "PHONE",
                        "IBLOCK_ID" => "46",
                        "IBLOCK_TYPE" => "feedbackmsgs",
                        "MAX_FILE_COUNT" => "10",
                        "MAX_FILE_SIZE" => "5",
                        "MESSAGE_ID" => "137",
                        "SUBJECT" => "Написать администратору",
                        "USE_CAPTCHA" => "N"
                )
        ); ?>
    </div>
    <div class="col-md-6 interlab-form interlab-form-writeBonuses4">
        <? $APPLICATION->IncludeComponent(
                "interlabs:feedbackform",
                "bonshop4",
                array(
                        "AGREE_PROCESSING" => "N",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "EMAIL_FROM" => "sale@sokolru.ru",
                        "EMAIL_TO" => "cavjob@yandex.ru , BaryshevaAD1@mos.ru, StarenkoOG@mos.ru, PORT-communications@mos.ru",
                        "EVENT_TYPE" => "INTERLABS_FEEDBACK",
                        "FIELD_CHECK" => array("PHONE", "EMAIL", "EVENT_CODE", "EVENT_NAME", "SCORES_QTT", "NAME", ""),
                        "FORM_ID" => "i_2",
                        "IBLOCK_FIELDS_USE" => array("NAME", "PHONE", "EMAIL", "EVENT_CODE", "EVENT_NAME", "SCORES_QTT"),
                        "IBLOCK_FIELD_EMAIL" => "EMAIL",
                        "IBLOCK_FIELD_PHONE" => "PHONE",
                        "IBLOCK_ID" => "47",
                        "IBLOCK_TYPE" => "feedbackmsgs",
                        "MAX_FILE_COUNT" => "10",
                        "MAX_FILE_SIZE" => "5",
                        "MESSAGE_ID" => "137",
                        "SUBJECT" => "Записать М-Баллы",
                        "USE_CAPTCHA" => "N"
                )
        ); ?> <!--<a href="<?php /*= SITE_DIR */ ?>index.php#feedback"> Написать администратору </a>-->
    </div>
</div>
