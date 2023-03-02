<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->addExternalCss("./styles.css");
?>
<div class = "lighthouse-wrapper">
    <h2>Жители</h2>
    <div class = "lighthouse-body">
    <?
    foreach ($arResult["RESIDENTS"] as $item){
        $fioValue = $item['FIO_VALUE'];
        $cityValue = $item['HOUSE_PROPS']['CITY'];
        $streetValue = $item['HOUSE_PROPS']['STREET'];
        $numberValue = $item['HOUSE_PROPS']['NUMBER'];

        echo "-- ${fioValue} - ${cityValue}, ${streetValue}, ${numberValue}<br>";
    }
    ?>
    </div>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        [
            "NAV_TITLE"=>"residents",
            "NAV_OBJECT" => $arResult['NAV_RESULT'],
            "SEF_MODE" => "N",
        ],
        false
    );
    ?>
</div>
