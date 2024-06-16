<?php

use PHPUnit\Framework\TestCase;

class PagesTest extends TestCase
{
    public function testPagesLoadSuccessfully()
    {
        $pages = ['sign-in.php', 'sign-up.php', /* add other pages here */];

        foreach ($pages as $page) {
            $response = file_get_contents($page);
            $this->assertFalse($response === false);
        }
    }

    public function testPageTitles()
    {
        $pages = [
            'sign-in.php' => 'Sign In',
            'sign-up.php' => 'Sign Up',
            // add other pages here
        ];

        foreach ($pages as $page => $expectedTitle) {
            $html = file_get_contents($page);
            $dom = new DOMDocument;
            @$dom->loadHTML($html);

            $title = $dom->getElementsByTagName('title')->item(0)->nodeValue;
            $this->assertEquals($expectedTitle, $title);
        }
    }
}


?>