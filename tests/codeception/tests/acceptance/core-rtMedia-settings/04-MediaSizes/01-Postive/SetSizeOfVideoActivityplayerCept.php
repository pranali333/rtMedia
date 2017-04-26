<?php

/**
* Scenario : To set height and width of video player for activity page.
*/

    use Page\Login as LoginPage;
    use Page\Constants as ConstantsPage;
    use Page\UploadMedia as UploadMediaPage;
    use Page\DashboardSettings as DashboardSettingsPage;
    use Page\BuddypressSettings as BuddypressSettingsPage;

    $scrollToDirectUpload = ConstantsPage::$masonaryCheckbox;

    $I = new AcceptanceTester($scenario);
    $I->wantTo('To set height and width of video player for activity page');

    $loginPage = new LoginPage($I);
    $loginPage->loginAsAdmin(ConstantsPage::$userName, ConstantsPage::$password);

    $settings = new DashboardSettingsPage($I);
    $settings->gotoTab( ConstantsPage::$mediaSizesTab,ConstantsPage::$mediaSizesTabUrl);
    $settings->setMediaSize( ConstantsPage::$activityPlayerLabel,ConstantsPage::$activityVideoWidthTextbox,ConstantsPage::$activityVideoPlayerWidth,ConstantsPage::$activityVideoHeightTextbox,ConstantsPage::$activityVideoPlayerHeight);

    $I->amOnPage( '/wp-admin/admin.php?page=rtmedia-settings#rtmedia-display' );
    $I->wait( 5 );
    $settings->verifyDisableStatus( ConstantsPage::$strDirectUplaodCheckboxLabel, ConstantsPage::$directUploadCheckbox, $scrollToDirectUpload );

    $I->amOnPage( '/wp-admin/admin.php?page=rtmedia-settings#rtmedia-bp' );
    $I->wait( 5 );
    $settings->verifyEnableStatus( ConstantsPage::$strMediaUploadFromActivityLabel, ConstantsPage::$mediaUploadFromActivityCheckbox );

    $I->amOnPage( '/wp-admin/admin.php?page=rtmedia-settings#rtmedia-types' );
    $I->wait( 5 );
    $settings->verifyEnableStatus( ConstantsPage::$videoLabel, ConstantsPage::$videoCheckbox );

    $buddypress = new BuddypressSettingsPage($I);
    $buddypress->gotoActivityPage( ConstantsPage::$userName );

    $uploadmedia = new UploadMediaPage( $I );
    $uploadmedia->uploadMediaFromActivity( ConstantsPage::$videoName );

    $I->wait( 5 );
    echo $I->grabAttributeFrom( ConstantsPage::$videoSelectorActivity, 'style' );

?>
