<?php

use PHPUnit\Framework\TestCase;

class SignInTest extends TestCase
{
    public function testSignInFormExists()
    {
        // Load the HTML from the sign-in.php file
        $html = file_get_contents('sign-in.php');

        // Create a new DOMDocument and load the HTML
        $dom = new DOMDocument;
        @$dom->loadHTML($html);

        // Look for the form
        $forms = $dom->getElementsByTagName('form');

        // Check that there is at least one form
        $this->assertGreaterThanOrEqual(1, $forms->length);

        if($forms->length > 0){
            // Check that the form's action is 'login.php'
            $this->assertEquals('login.php', $forms->item(0)->getAttribute('action'));
        }
    }

    public function testInputFieldsExist()
    {
        $html = file_get_contents('sign-in.php');
        $dom = new DOMDocument;
        @$dom->loadHTML($html);

        $inputs = $dom->getElementsByTagName('input');
        $this->assertGreaterThanOrEqual(2, $inputs->length);
    }

    public function testSubmitButtonExists()
    {
        $html = file_get_contents('sign-in.php');
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
    
        $submitButtonFound = false;
    
        $buttons = $dom->getElementsByTagName('button');

        foreach ($buttons as $button) {
            if ($button->getAttribute('type') === 'submit') {
                $submitButtonFound = true;
                break;
            }
        }
    
        $this->assertTrue($submitButtonFound);
    }

    public function testFormUsesPostMethod()
    {
        $html = file_get_contents('sign-in.php');
        $dom = new DOMDocument;
        @$dom->loadHTML($html);

        $forms = $dom->getElementsByTagName('form');
        $this->assertEquals('post', strtolower($forms->item(0)->getAttribute('method')));
    }
}
?>