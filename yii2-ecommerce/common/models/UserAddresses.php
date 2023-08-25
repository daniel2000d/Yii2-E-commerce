<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_adresses}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $zipcode
 */
class UserAddresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_adresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address', 'city', 'state', 'country'], 'required'],
            [['user_id'], 'integer'],
            [['address', 'city', 'state', 'country', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UserAddressesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserAddressesQuery(get_called_class());
    }
}
