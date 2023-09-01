<?php

namespace frontend\controllers;

use common\models\CartItem;
use common\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends \frontend\base\Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
        }else{
            $cartItems=CartItem::findBySql("
                    SELECT
                c.product_id as id ,
                p.image,
                p.name,
                p.price,
                c.quantity,
                p.price * c.quantity as total_price
            FROM cart_items  c
                    LEFT JOIN  products p on p.id=c.product_id
                    WHERE c.created_by=:userId",[
                'userId'=>\Yii::$app->user->id
            ])  ->asArray()
                ->all();



        }
        return $this->render('index',[
            'items'=>$cartItems
        ]);
    }

    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        $product = Product::find()->id($id)->published()->one();
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }

        if (\Yii::$app->user->isGuest) {

            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $found = false;
            foreach ($cartItems as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cartItem = [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total_price' => $product->price
                ];
                $cartItems[] = $cartItem;
            }

            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        } else {
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->productId($id)->one();
            if ($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = $userId;
                $cartItem->quantity = 1;
            }
            if ($cartItem->save()) {
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $cartItem->errors
                ];
            }
        }
    }



}