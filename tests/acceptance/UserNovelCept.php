<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('test everything under the sun... one moment...');
$I->wantTo('sign up for a new account');
$I->amOnPage('/register');
$I->fillField('Name', 'Test User');
$I->fillField('Email Address', 'test.user@gmail.com');
$I->fillField('Password', 'batman');
$I->fillField('Confirm Password', 'batman');
$I->click('Sign Up');
$I->seeCurrentUrlEquals('/home');

$I->wantTo('sign out and check I can log back in successfully');
$I->see('Sign Out');
$I->click('Sign Out');
$I->seeCurrentURlEquals('/');
$I->amOnPage('/login');
$I->fillField('Email Address', 'test.user@gmail.com');
$I->fillField('Password', 'batman');
$I->click('Log In');
$I->seeCurrentUrlEquals('/home');

$I->wantTo('add a category and get started');
$I->amOnPage('/home');
$I->see('Add a Category Below');
$I->fillField('Category Name', 'Test Category');
$I->click('Add Category');
$I->seeCurrentUrlEquals('/home');
$I->see('Test Category');
