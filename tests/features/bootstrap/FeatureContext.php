<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/*
Theoretically updated in behat 3 to something like:
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\CustomSnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
*/

require_once realpath(__DIR__.'/../../../').'/config.php';
//require_once    ROOT.'vendor/autoload.php';
require_once    ROOT.'vendor/autoload.php';
require_once ROOT.'vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';
require_once ROOT.'tests/features/bootstrap/FeatureHelper.php';

require_once ROOT.'core/core.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }

    /* Pull in the various functions from the trait Feature Helper, for helpers that aren't feature tests*/
    use FeatureHelper;


    // Simple helper function to ensure a url doesn't 404 or error out.
    function urlDoesntError($url)
    {
        $headers = get_headers($url, 1); // Get headers as array.
        if ($headers[0] == 'HTTP/1.0 200 OK') {
            return true;
        } else {
            return false;
        }
    }

    // Check whether a url returns some json.
    function bespokeIsJSON($content)
    {
        json_decode($content);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    // Simple helper function to get any arbitrary url's contents.
    function getUrlContents($url)
    {
        $headers = get_headers($url, 1); // Get headers as array.
        if ($headers[0] == 'HTTP/1.0 200 OK') {
            return file_get_contents($url); // Get the contents of the url to do whatever with.
        }
        return null; // Nope, it didn't load right.
    }

    // Change a relative url like '/something' to an absolute url like localhost:7777/something
    function appUrl($url)
    {
        // Strip the first slash.
        $url = ltrim($url, '/');
        // Prepend the base url.
        return BASE_URL.$url;
    }

    /**
     * @Given I can load the dev url :arg1
     */
    public function iCanLoadTheDevUrl($url)
    {
        $this->urlDoesntError($this->appUrl($url));
    }

    /**
     * @When I move to the url :arg1
     */
    public function iMoveToTheUrl($url)
    {
        $this->urlDoesntError($this->appUrl($url));
        $this->output = $this->getUrlContents($this->appUrl($url));
    }

    /**
     * @Then I should get:
     */
    public function iShouldGet(PyStringNode $expected)
    {
        if (strpos((string) $expected,$this->output) !== false ) {
            throw new Exception(
                "Actual output is:\n" . $this->output
            );
        }
    }



    /**
     * @Given I have phrases in system:
     */
    public function iHavePhrasesInSystem(TableNode $table)
    {
        // Stick these phrases into the system as the only values.
        $data = $table->getHash();
        foreach($data as $row){
            $phrase = $row['phrase'];
            $rating = $row['rating'];
            $check = (null != $phrase && null != $rating 
                && is_string($row['phrase']) && is_numeric($row['rating']));
            if(!$check){
                throw new Exception('The phrases in the system should be valid');
            }
        }
    }

    /**
     * @Given I am not logged in
     */
    public function iAmNotLoggedIn()
    {
        throw new PendingException();
    }

    /**
     * @When I pull from the api :arg1
     */
    public function iPullFromTheApi($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see
     */
    public function iShouldSee(PyStringNode $string)
    {
        throw new PendingException();
    }


    /**
     * @Given I can cast :arg1
     */
    public function iCanCast($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given the target :arg1 has :arg2 hitpoints
     */
    public function theTargetHasHitpoints($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When I cast :arg1 on :arg2
     */
    public function iCastOn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then He loses some health
     */
    public function heLosesSomeHealth()
    {
        throw new PendingException();
    }



    /**
     * @Given I am the wizard :arg1
     */
    public function iAmTheWizard($wizard_name)
    {
        $wizard = WizardFactory::create($wizard_name);
        assert($wizard instanceof Wizard);
        assert($wizard->identity() === $wizard_name);
    }

    /**
     * @Given I have the spells :arg1, :arg2, :arg3
     */
    public function iHaveTheSpells($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Then when I view my spell pool, I should only have the given spells
     */
    public function mySpellPoolMatchesGivenSpells()
    {
        throw new PendingException();
    }


}
