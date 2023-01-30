<?php

class Bd {

    private $conexion;

    public function __construct() {
        try {
            // Crea una instancia de PDO para conectarse a la base de datos
            $this->conexion = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (Exception $ex) {
            throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
        }
    }
    

        /**
         * @param: $query
         * @param: $param
         * @return: $result
         * La funcion select nos permitira realizar consultas preparadas y recibir como resultado un array asociativo con los datos
         */
        public function select($query="",$param=[]) {
            // Creamos un array vacio donde guardaremos los datos recibidos
            $resultados = [];
            try {
                // creamos una consulta preparada a la cual pasaremos por parametros la consulta recibida. En caso de fallar generaremos una excepcion.
                if(!$stmt = $this->conexion->prepare($query)){
                    throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
                }
                /* Comprobamos que hayan pasado parametros, en caso de que el array de parametros no este vacio iremos enlazaremos cada parametro con la consulta
                es importante saber que con foreach tendremos problemas al realizar consultas con varias condiciones por eso elegi el bucle for para recorrer el array*/
                if(count($param)!=0){
                    for ($i=1; $i <= count($param); $i++) { 
                        $stmt->bindParam($i,$param[$i-1]);
                    }
                }
                // Ejecutamos la sentencia.
                if(!$stmt->execute()){
                    throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
                }
                // con un bucle while recorreremos los resultados los cuales indicaremos que nos lo devuleva como un array asociativo. Cada resultado lo guardaremos en $result.
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($resultados,$row);
                }
            } catch (Exception $e) {
                throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
            }
            // cerramos el cursor
            $stmt->closeCursor();
            return $resultados;
        }
        // La funcion consulta es igual que la funcion query, la diferencia es que no devolveremos un array como resultado si no un valor booleano indicando si la operacion se pudo realizar
        public function consulta($query="",$param){
            try {
                $i = 1;
                if(!$stmt = $this->conexion->prepare($query)){
                    throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
                }
                if(count($param)!=0){
                    for ($i=1; $i <= count($param); $i++) { 
                        $stmt->bindParam($i,$param[$i-1]);
                    }
                }
                return $stmt->execute();
            } catch (Exception $e) {
                throw new Exception("La base de datos está en mantenimiento, por favor intentelo más tarde.");
            }
            $stmt->closeCursor();
        }
}
