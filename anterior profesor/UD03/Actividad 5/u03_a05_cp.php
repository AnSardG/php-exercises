<?php
/**
 * Clase para instanciar objetos que simularán una cuenta bancaria,
 * con funcionalidades básicas de dicho tipo de objeto.
 */
class CuentaBancaria {

    /**
     * ATRIBUTOS:
     */

    /** Nombre del titular de la cuenta. */
    private $usuario;
    /** PIN de seguridad de la cuenta. */
    private $pin;
    /** Lista de entradas (depósitos). */
    private $entradas;
    /** Lista de salidas (retiros). */
    private $salidas;
    /** Saldo actual de la cuenta. */
    private $saldo;

    /**
     * CONSTRUCTORES:
     */

    /**    
     * Método constructor básico de la clase, recibe el nombre y el PIN del
     * usuario y inicializa el resto de atributos a array vacío y saldo nulo.
     * 
     * @param string $usuario El nombre de usuario de la cuenta bancaria.
     * @param string $pin El PIN de la cuenta bancaria.
     */
    public function __construct($usuario, $pin) {
        $this->usuario=$usuario;
        $this->pin=$pin;
        $this->entradas=array();
        $this->salidas=array();
        $this->saldo=0;
    }

    /** 
     * MÉTODOS: 
    */

    /**
     * Método para cambiar el PIN de la cuenta a modo de setter.
     * 
     * @param string $pin El PIN de la cuenta bancaria a cambiar.
     */
    public function cambiaPin($pin) {
        $this->pin=$pin;
    }

    /**
     * Método para validar el usuario y el PIN.
     * 
     * @param string $usuario El nombre de usuario de la cuenta bancaria.
     * @param string $pin El PIN del usuario de la cuenta bancaria.
     * @return boolean La validación satisfactoria (o no) del usuario.
     */
    public function validaUsuario($usuario, $pin) {
        if($this->usuario==$usuario && $this->pin==$pin) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Método para realizar un depósito, se añadirá la cantidad a la lista de 
     * entradas de la cuenta y se sumará al saldo actual.
     * 
     * @param double $cantidad La cantidad decimal a ingresar en la cuenta bancaria.
     */
    public function ingresar($cantidad) {
        $this->entradas[]=$cantidad;
        $this->saldo=$this->saldo+$cantidad;
    }

    /**
     * Método para realizar un retiro, si la cantidad especificada a retirar supera
     * al saldo actual no se ejecutará; en caso contrario, se registrará dicha cantidad
     * a la lista de salidas de la cuenta y se restará al saldo actual.
     * 
     * @param double $cantidad La cantidad decimal a retirar de la cuenta bancaria.
     * @return boolean La ejecución satisfactoria (o no) del retiro bancario.
     */
    public function sacar($cantidad) {
        if($cantidad > $this->saldo) {
            return false;
        }
        else {
            $this->salidas[]=$cantidad;
            $this->saldo=$this->saldo-$cantidad;
            return true;
        }
    }

    /**
     * Método para obtener el saldo actual de la cuenta a modo de getter.
     * 
     * @return double El saldo actual de la cuenta.
     */
    public function getSaldo() {
        return $this->saldo;
    }

    /**
     * Método para obtener la lista de entradas en la cuenta a modo de getter.
     * 
     * @return array La lista de todas las entradas realizadas en la cuenta.
     */
    public function getEntradas() {
        return $this->entradas;
    }

    /**
     * Método para obtener la lista de salidas en la cuenta a modo de getter.
     * 
     * @return array La lista de todas las salidas realizadas en la cuenta.
     */
    public function getSalidas() {
        return $this->salidas;
    }
}

/**
 * Creación de una instancia de la clase CuentaBancaria utilizando el método constructor, 
 * al que se le pasará el usuario como primer parámetro y el PIN como segundo.
 */
$cuenta=new CuentaBancaria("Fidel","1234");

/** En caso de que el usuario sea correcto comenzará la lógica del programa. */
if($cuenta->validaUsuario("Fidel","1234")) {
    echo "usuario válido <br/>";
    echo "Saldo actual: ".$cuenta->getSaldo()."<br/>";

    /** Realización de un depósito de 100€ y muestra del saldo actual. */
    $cuenta->ingresar(100);
    echo "Se han ingresado 100€, saldo actual: ".$cuenta->getSaldo()."€<br/>";

    /** Intento de retiro de 80€ y muestra el saldo actual si es exitoso .*/
    if($cuenta->sacar(80)) {
        echo "Se han sacado 80€, saldo actual: ".$cuenta->getSaldo()."€<br/>";

        /** Bucle iterativo que muestra todas las entradas realizadas en la cuenta. */
        echo "<h3>Listado entradas</h3>";
        foreach($cuenta->getEntradas() as $entrada) {
            echo "Entrada: $entrada <br/>";
        }

        /** Bucle iterativo que muestra todas las salidas realizadas en la cuenta. */
        echo "<h3>Listado salidas</h3>";
        foreach($cuenta->getSalidas() as $salida) {
            echo "Salida: $salida <br/>";
        }
    }

    /** En caso de no poder retirar el dinero especificado, muestra un mensaje de error. */
    else {
        echo "No tienes suficiente dinero en la cuenta";
    }
}

/** En caso de que el usuario sea incorrecto, se mostrará un mensaje de error. */
else {
    echo "usuario no válido";
}
