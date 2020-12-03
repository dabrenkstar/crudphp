<?php
namespace App\Models;

use PDO;

class Conex
{
    private static function init()
    {
        $db_type = 'mysql';
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pwd = '';
        $db_name = 'crudphp';

        $_dsn = $db_type . ":host=" . $db_host . ";dbname=" . $db_name;
        return [$_dsn, $db_user, $db_pwd];
    }

    private static function connect()
    {
        try {
            $data = self::init();
            $_dsn = $data[0];
            $user = $data[1];
            $passwd = $data[2];
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,

                PDO::ATTR_EMULATE_PREPARES => false);

            $pdo = new PDO($_dsn, $user, $passwd, $options);

            return $pdo;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();

            return null;
        }
    }

    public static function getAll($_query, $_params_array = null)
    {
        try {
            $pdo = self::connect();

            if ($_params_array == null) {
                $result = $pdo->query($_query)->fetchAll();
            } else {
                $stmt = $pdo->prepare($_query);

                $stmt->execute($_params_array);

                $result = $stmt->fetchAll();
            }

            return $result;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage() . " " . $_query;

            return null;
        }
    }

    public static function getRow($_query, $_params_array = null)
    {
        try {
            $pdo = self::connect();

            if ($_params_array == null) {
                $result = $pdo->query($_query)->fetch();
            } else {
                $stmt = $pdo->prepare($_query);

                $stmt->execute($_params_array);

                $result = $stmt->fetch();
            }

            return $result;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage() . " " . $_query;

            return null;
        }
    }

    public static function getOne($_query, $_params_array = null)
    {
        try {
            $pdo = self::connect();

            if ($_params_array == null) {
                $result = $pdo->query($_query)->fetchColumn();
            } else {
                $stmt = $pdo->prepare($_query);

                $stmt->execute($_params_array);

                $result = $stmt->fetchColumn();
            }

            return $result;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage() . " " . $_query;

            return null;
        }
    }

    public static function query($_query, $_params_array = null)
    {
        try {
            $pdo = self::connect();

            if ($_params_array == null) {
                $result = $pdo->query($_query);
            } else {
                $stmt = $pdo->prepare($_query);

                $result = $stmt->execute($_params_array);
            }

            return $result;
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage() . " " . $_query;

            return null;
        }
    }
}
