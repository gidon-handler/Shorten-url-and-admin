<?php

namespace app\models;

use Exception;
use Yii;

/**
 * This is the model class for table "urls".
 *
 * @property string $id
 * @property string $original_url
 * @property resource $short_url
 * @property string $date_created
 * @property string $counter
 */
class Urls extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'urls';
    }


    public function rules()
    {
        return [
            [['original_url', 'short_url'], 'required'],
            [['date_created', 'counter'], 'integer'],
            [['original_url'], 'string', 'max' => 255],
            [['short_url'], 'string', 'max' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'original_url' => 'Original Url',
            'short_url' => 'Short Url',
            'date_created' => 'Date Created',
            'counter' => 'Counter',
        ];
    }

    protected static $chars = "123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
    protected static $checkUrlExists = false;

    protected $timestamp;

    public function urlToShortCode($url)
    {
        $this->timestamp = $_SERVER["REQUEST_TIME"];
        if (empty($url)) {
            throw new Exception("No URL was supplied.");
        }

        if ($this->validateUrlFormat($url) == false) {
            throw new Exception(
                "URL does not have a valid format.");
        }

        if (self::$checkUrlExists) {
            if (!$this->verifyUrlExists($url)) {
                throw new Exception(
                    "URL does not appear to exist.");
            }
        }

        $shortCode = $this->urlExistsInDb($url);
        if ($shortCode == false) {
            $shortCode = $this->createShortCode($url);
        }

        return $shortCode;
    }

    protected function validateUrlFormat($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL,
            FILTER_FLAG_HOST_REQUIRED);
    }

    protected function verifyUrlExists($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (!empty($response) && $response != 404);
    }

    protected function urlExistsInDb($url)
    {

        $query = $this->find()->where(['original_url' => $url ])->asArray();
        $result = $query->one();

        return (empty($result)) ? false : $result["short_url"];
    }

    protected function createShortCode($url)
    {
        $id = $this->insertUrlInDb($url);
        $shortCode = $this->convertIntToShortCode($id);
        $this->insertShortCodeInDb($id, $shortCode);
        return $shortCode;
    }

    protected function insertUrlInDb($url)
    {


        Yii::$app->db->createCommand()->insert('urls', [
            'original_url' => $url,
            'date_created' => $this->timestamp,
        ])->execute();
        $id = Yii::$app->db->getLastInsertID();

        return $id;
    }

    protected function convertIntToShortCode($id)
    {
        $id = intval($id);
        if ($id < 1) {
            throw new Exception(
                "The ID is not a valid integer");
        }

        $length = strlen(self::$chars);
        // make sure length of available characters is at
        // least a reasonable minimum - there should be at
        // least 10 characters
        if ($length < 10) {
            throw new Exception("Length of chars is too small");
        }

        $code = "";
        while ($id > $length - 1) {
            // determine the value of the next higher character
            // in the short code should be and prepend
            $code = self::$chars[fmod($id, $length)] .
                $code;
            // reset $id to remaining value to be converted
            $id = floor($id / $length);
        }

        // remaining value of $id is less than the length of
        // self::$chars
        $code = self::$chars[$id] . $code;

        return $code;
    }

    protected function insertShortCodeInDb($id, $code)
    {
        if ($id == null || $code == null) {
            throw new Exception("Input parameter(s) invalid.");
        }
//        $query = "UPDATE " . self::$table .
//            " SET short_code = :short_code WHERE id = :id";
//        $stmnt = $this->pdo->prepare($query);
//        $params = array(
//            "short_code" => $code,
//            "id" => $id
//        );
//        $stmnt->execute($params);
        Yii::$app->db->createCommand()->update('urls', ['short_url' => $code,], "id=$id")->execute();

        return true;
    }


    public function shortCodeToUrl($code, $increment = true) {
        if (empty($code)) {
            throw new Exception("No short code was supplied.");
        }


        $urlRow = $this->getUrlFromDb($code);
        if (empty($urlRow)) {
            throw new Exception(
                "Short code does not appear to exist.");
        }

        if ($increment == true) {
            $this->incrementCounter($urlRow["id"]);
        }

        return $urlRow["original_url"];
    }



    protected function getUrlFromDb($code) {
//        $query = "SELECT id, long_url FROM " . self::$table .
//            " WHERE short_code = :short_code LIMIT 1";
//        $stmt = $this->pdo->prepare($query);
//        $params=array(
//            "short_code" => $code
//        );
//        $stmt->execute($params);
//
//        $result = $stmt->fetch();
        $query = $this->find()->where(["short_url" => $code]);
        $result = $query->one();
        return (empty($result)) ? false : $result;
    }

    protected function incrementCounter($id) {
//        $query = "UPDATE " . self::$table .
//            " SET counter = counter + 1 WHERE id = :id";
//        $stmt = $this->pdo->prepare($query);
//        $params = array(
//            "id" => $id
//        );
//        $stmt->execute($params);
        Yii::$app->db->createCommand()->update('urls', ['counter' => 'counter + 1',], "id=$id")->execute();
    }
}

