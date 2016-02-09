<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Feel welcome');
$I->amOnPage('/');
$I->see('Welcome');
//$I->feel('better');
