<?php

namespace Tests\DB;


final class FileStorageTest extends \PHPUnit\Framework\TestCase {

    /**
     * @var \Cursos\DB\FileStorage
     */
    private $db;

    protected function setUp() : void {
        $this->db = new \Cursos\DB\FileStorage(dirname(__FILE__).'/../../config/');
    }

    protected function tearDown() : void {
        $this->db->dropDB();
    }

    public function testSaveOne() {
        $r = $this->db->save("uno", array('nombre' => 'pepe', 'edad' => 18));

        $this->assertTrue($r);
    }

    public function testSaveAndFindOne() {
        $data = array('nombre' => 'jose', 'edad' => 20);
        $this->db->save("otro", $data);

        $condition = new \Cursos\DB\Condition('nombre', '=', 'jose');

        $r = $this->db->findOne("otro", array($condition));

        $this->assertTrue(!empty($r));
        $this->assertSame($r, $data);
    }

    public function testNotFindingOne() {
        $condition = new \Cursos\DB\Condition('nombre', '=', 'jose');

        $r = $this->db->findOne("otro", array($condition));

        $this->assertTrue(empty($r));
    }

    public function testFindLessThan() {
        for($i=0; $i<20; $i++){
            $data = array('nombre' => 'jose'.$i, 'edad' => 20+$i);
            $this->db->save("nombres", $data);
        }

        $condition = new \Cursos\DB\Condition('edad', '<', 25);
        $r = $this->db->find("nombres", array($condition));

        $this->assertTrue(!empty($r));
        $this->assertEquals(5, count($r));
    }

    public function testFindMoreThan() {
        for($i=0; $i<20; $i++){
            $data = array('nombre' => 'jose'.$i, 'edad' => 20+$i);
            $this->db->save("nombres", $data);
        }

        $condition = new \Cursos\DB\Condition('edad', '>', 25);
        $r = $this->db->find("nombres", array($condition));

        $this->assertTrue(!empty($r));
        $this->assertEquals(14, count($r));
    }
}