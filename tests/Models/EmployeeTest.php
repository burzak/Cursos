<?php

namespace Tests\Models;

use \Cursos\Models\Employee;


final class EmployeeTest extends \PHPUnit\Framework\TestCase {

    public function testCreateWithValues() {
        for($i=0; $i<10; $i++) {
            $employee = new Employee("mail@mail.com".$i, "carlos".$i, "garcia".$i, "dev".$i, "pagos".$i, 1);
            $this->assertEquals("mail@mail.com".$i, $employee->getEmail());
            $this->assertEquals("carlos".$i, $employee->getNombre());
            $this->assertEquals("garcia".$i, $employee->getApellido());
            $this->assertEquals("dev".$i, $employee->getPuesto());
            $this->assertEquals("pagos".$i, $employee->getPrograma());
            $this->assertEquals(1, $employee->getActivo());
            
            $asArray = $employee->asArray();
            $this->assertEquals("mail@mail.com".$i, $asArray['email']);
            $this->assertEquals("carlos".$i, $asArray['nombre']);
            $this->assertEquals("garcia".$i, $asArray['apellido']);
            $this->assertEquals("dev".$i, $asArray['puesto']);
            $this->assertEquals("pagos".$i, $asArray['programa']);
            $this->assertEquals(1, $asArray['activo']);
        }
    }
}