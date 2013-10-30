<?php
/**
 * @package   ImpressPages
 */

namespace Tests\InternalRequest;


class ExperimentTest extends \PhpUnit\GeneralTestCase
{
    public function setup()
    {
//        parent::setup();
//        $config = include __DIR__ . '/ipConfig-default.php';
//        \Ip\Config::init($config);
    }

//    public function testRenderHomepage()
//    {
//        \PhpUnit\Helper\TestEnvironment::cleanupFiles();
//        \PhpUnit\Helper\TestEnvironment::prepareFiles();
//        \PhpUnit\Helper\TestEnvironment::initCode();
//
//        $application = new \Ip\Core\Application();
//        $response = $application->handleRequest();
//        $this->assertNotEmpty($response);
//    }
//
//    public function testUseMinkToRenderHomepage()
//    {
//        \PhpUnit\Helper\TestEnvironment::cleanupFiles();
//        \PhpUnit\Helper\TestEnvironment::prepareFiles();
//        \PhpUnit\Helper\TestEnvironment::initCode();
//
//        // init Mink:
//        $driver = new \PhpUnit\Helper\Mink\InternalDriver();
//        $session = new \Behat\Mink\Session($driver);
//        $session->start();
//
//        $session->visit(BASE_URL);
//
//        // get the current page URL:
//        $this->assertEquals(BASE_URL, $session->getCurrentUrl());
//
//        $page = $session->getPage();
//
//        $homepageTitle = $page->find('css', 'title');
//        $this->assertNotEmpty($homepageTitle, 'Homepage rendering is broken!');
//        $this->assertEquals('Home', $homepageTitle->getText());
//
//        $headlineElement = $page->find('css', 'p.homeHeadline');
//        $this->assertNotEmpty($headlineElement, 'Headline is not visible!');
//        $this->assertEquals('ImpressPages theme Blank', $headlineElement->getText());
//    }

    public function testUseMinkToRenderEnVersion()
    {
        \PhpUnit\Helper\TestEnvironment::cleanupFiles();
        \PhpUnit\Helper\TestEnvironment::prepareFiles();
        \PhpUnit\Helper\TestEnvironment::initCode();

        // init Mink:
        $driver = new \PhpUnit\Helper\Mink\InternalDriver();
        // $driver = new \Behat\Mink\Driver\GoutteDriver();
        $session = new \Behat\Mink\Session($driver);
        $session->start();

        $session->visit(\Ip\Config::baseUrl('someNonExistentPage'));

        $this->assertEquals(404, $session->getStatusCode());

        \PhpUnit\Helper\TestEnvironment::initCode();
        $session->visit(\Ip\Config::baseUrl('en/'));

        $page = $session->getPage();

        $homepageTitle = $page->find('css', 'title');
        $this->assertNotEmpty($homepageTitle, 'Homepage rendering is broken!');
        $this->assertEquals('Home', $homepageTitle->getText());

        $headlineElement = $page->find('css', 'p.homeHeadline');
        $this->assertNotEmpty($headlineElement, 'Headline is not visible!');
        $this->assertEquals('ImpressPages theme Blank', $headlineElement->getText());
    }

}