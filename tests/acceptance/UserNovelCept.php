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

$I->wantTo('add another category');
$I->fillField('Category Name', 'My Next Category');
$I->fillField('Category Description', 'I can put whatever I want here???');
$I->click('Add Category');
$I->seeCurrentUrlEquals('/home');
$I->see('My Next Category');
$I->see('I can put whatever I want');

$I->wantTo('add a bookmark to Test Category');
$I->click('Test Category');
$I->seeInCurrentUrl('edit-category');
$I->see('This category has 0 bookmarks.');
$I->see('Add a Bookmark to this Category:');
$I->fillField('Bookmark Name', 'Laravel');
$I->fillField('Bookmark URL', 'https://laravel.com/');
$I->fillField('Bookmark Description', 'The PHP Framework for Web Artisans');
$I->click('Add Bookmark');
$I->seeInCurrentUrl('edit-category');
$I->see('This category has 1 bookmark.');
$I->see('Laravel');
$I->see('The PHP Framework for Web Artisans');

$I->wantTo('change the category description while I\'m here');
$I->see('Editing Category: Test Category');
$I->fillField('Category Description', 'The best damn category, period.');
$I->click('Save Changes');
$I->seeInCurrentUrl('edit-category');
$I->see('The best damn category, period.');

$I->wantTo('remove that bookmark I added.');
$I->click('Remove');
$I->seeInCurrentUrl('edit-category');
$I->see('This category has 0 bookmarks.');
