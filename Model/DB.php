<?php

namespace Model;

use PDO;
use PDOException;

class DB {

    private string $host = 'localhost';
    private string $db = 'LocalTroc';
    private string $user = 'dev';
    private string $password = 'dev';

    private static ?PDO $pdo = null;

    /**
     *  my DB constructor.
     */
    public function __construct() {
        try {
            self::$pdo = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->user, $this->password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception) {
            echo "Erreur de connexion: " . $exception->getMessage();
        }
    }

    /**
     * Return the database PDO connection
     * @return PDO|null
     */
    public static function getInstance(): ?PDO {
        if(null === self::$pdo) {
            new self();
        }
        return self::$pdo;
    }


    /**
     * Return string to have secure data to insert into the BDD.
     * @param $data
     * @return string
     */

    public static function secureData($data): string {
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        $data = addslashes($data);
        return trim($data);
    }

    /**
     * Return secure int to have secure data to insert into the BDD.
     * @param $data
     * @return int
     */
    public static function secureInt($data): int {
        return intval($data);
    }

    /**
     * Check if password is correct
     * @param $psswd
     * @return bool
     */
    public static function checkPassword($psswd): bool {
        $majuscule = preg_match('@[A-Z]@', $psswd);
        $minuscule = preg_match('@[a-z]@', $psswd);
        $number = preg_match('@[0-9]@', $psswd);

        if(!$majuscule || !$minuscule || !$number || strlen($psswd) < 5 ) {
            return false;
        }

        return true;
    }

    /**
     * Return true if at least one parameter is null !
     * @param mixed ...$data
     * @return bool
     */
    public static function isNull(...$data): bool {
        foreach($data as $param) {
            if(is_null($param)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Encode a given plain password
     * @param $plainPassword
     * @return string
     */
    public static function encodePassword($plainPassword): string {
        // Encoding password.
        $password = self::secureData($plainPassword);
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * avoid clone by another dev
     */
    public function __clone() {}
}