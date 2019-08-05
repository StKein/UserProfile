<?php
session_start();
?>
<html>
    <head>
        <link rel="stylesheet/less" type="text/css" href="/css/style.less" />
        <script type="text/javascript">less = { env: "development" };</script>
        <script type="text/javascript" src="/js/lib/less.min.js"></script>
        <?php include_once __DIR__."/engine/TextManager.php";?>
    </head>
    <body>
        <div class="content_fundamental_wrapper">
            <div class="echo _echo"></div>
			<div class="content_wrapper _tab_content _mod-active" data-type="profile">
                <?php include_once __DIR__."/controllers/main.php";?>
			</div>
			<div class="content_wrapper _tab_content" data-type="user_form"></div>
            <div class="language_switcher_wrapper">
                <span class="language_switcher_text"><?=$text_manager->getText("LanguageSwitcher");?></span>
                <select class="language_switcher _language_switcher">
                <?php foreach( $text_manager->getAvailableLanguages() as $language ):
                    $selected = ( $language == $_SESSION["language"] || !$_SESSION["language"] && $language == TextManager::DEFAULT_LANGUAGE ) ? " selected" : "";?>
                    <option class="language" value="<?=$language?>" <?=$selected?>><?=$language?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
        <script type="text/javascript" src="/js/lib/jquery.js"></script>
        <script type="text/javascript" src="/js/functions.js"></script>
        <script type="text/javascript" src="/js/ContentManager.js"></script>
        <script type="text/javascript" src="/js/Validator.js"></script>
        <script type="text/javascript" src="/js/UserAccount.js"></script>
        <script type="text/javascript" src="/js/UserProfile.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
    </body>
</html>