<?php 

use HeadlessChromium\BrowserFactory;

require_once 'vendor/autoload.php';

$browserFactory = new BrowserFactory();

// starts headless Chrome
$browser = $browserFactory->createBrowser();

try {
    // creates a new page and navigate to an URL
    $page = $browser->createPage();
    $page->navigate('http://example.com')->waitForNavigation();

    // get page title
    $pageTitle = $page->evaluate('document.title')->getReturnValue();

    // screenshot - Say "Cheese"! 😄
    $page->screenshot()->saveToFile('/foo/bar.png');

    // pdf
    $page->pdf(['printBackground' => false])->saveToFile('bar.png');
} finally {
    // bye
    $browser->close();
}