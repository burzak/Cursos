<?php

namespace Tests\Services;

final class LoginServiceTest extends \PHPUnit\Framework\TestCase {

    private $db;
    /**
     * @var \Cursos\Services\LoginService
     */
    private $loginService;

    protected function setUp(): void {
        $this->db = new \Cursos\DB\MemoryStorage();
        $this->loginService = new \Cursos\Services\LoginService($this->db);

        // feo feo feo con f de foca
        $_SESSION = array();
    }

    protected function tearDown() : void {
        $this->db->dropDB();
    }

    public function testRegisterUser() {
        $r = $this->loginService->register('admin', '123456');
        $this->assertTrue($r);
    }
    
    public function testRegisterUserAndItExists() {
        $r = $this->loginService->register('admin', '123456');
        $exists = $this->loginService->userExists('admin');

        $this->assertTrue($r);
        $this->assertTrue($exists);
    }

    public function testUserDoesntExists() {
        $r = $this->loginService->userExists('lolo');
        $this->assertFalse($r);
    }

    public function testUserCantLogin() {
        $r = $this->loginService->logIn('admin', '121212');
        
        $this->assertFalse($r);
    }

    public function testUserCanLogin() {
        $r = $this->loginService->register('coco', 'pelota');

        $loggedin = $this->loginService->logIn('coco', 'pelota');

        $this->assertTrue($r);
        $this->assertTrue($loggedin);
    }

    public function testIsNotLogged() {
        $r = $this->loginService->isLogged();

        $this->assertFalse($r);
    }

    public function testIsLogged() {
        $this->loginService->register("pepe", "bartolo");

        $this->loginService->logIn("pepe", "bartolo");

        $r = $this->loginService->isLogged();
        $this->assertTrue($r);
    }
}