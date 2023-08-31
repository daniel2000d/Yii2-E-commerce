<?php

namespace frontend\controllers;

use common\models\CartItem;
use common\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController extends Controller
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
        $id=\yii::$app->request->post('id');
        $product=Product::find()->id($id)->one();
        if(!$product){
            throw new NotFoundHttpException();
        }
        if(\Yii::$app->user->isGuest) {
        } else{
                    $cartItem=new CartItem();
                    $cartItem->product_id=$id;
                    $cartItem->created_by=\Yii::$app->user->id;
                    $cartItem->quantity=1;
                    if($cartItem->save()){
                        return [
                            'success'=>true
                        ];

                    }else{
                            return [
                                'success'=>false,
                                'errors'=>$cartItem->errors
                            ];
                    }
            }

        }




}