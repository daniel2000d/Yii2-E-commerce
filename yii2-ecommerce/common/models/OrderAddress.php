<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_addresses}}".
 *
 * @property int $order_id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $zipcode
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_addresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'city', 'state', 'country'], 'required'],
            [['address', 'city', 'state', 'country', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderAddressQuery(get_called_class());
    }
}
