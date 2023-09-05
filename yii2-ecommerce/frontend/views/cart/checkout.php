<?php


/** @var \common\models\Order $order */
/** @var \common\models\OrderAddress $orderAddress */
/** @var array $cartItems */
/** @var int $productQuantity */

/** @var float $totalPrice */

use yii\bootstrap4\ActiveForm;

?>


<div class="row">
    <div class="col">
        <?php $form = ActiveForm::begin([
            'id' => 'checkout-form',
        ]); ?>
        <div class="card mb-3">
            <h3>Order summary # <?php echo $order->id?> :</h3>
            <div class="card-header">

                <h5>Account information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($order, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
                <?= $form->field($order, 'email')->textInput(['autofocus' => true]) ?>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Address information</h5>
            </div>
            <div class="card-body">
                <?= $form->field($orderAddress, 'address') ?>
                <?= $form->field($orderAddress, 'city') ?>
                <?= $form->field($orderAddress, 'state') ?>
                <?= $form->field($orderAddress, 'country') ?>
                <?= $form->field($orderAddress, 'zipcode') ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <img src="<?php echo \common\models\Product::formatImageUrl($item['image']) ?>"
                                     style="width: 50px;"
                                     alt="<?php echo $item['name'] ?>">
                            </td>
                            <td><?php echo $item['name'] ?></td>
                            <td>
                                <?php echo $item['quantity'] ?>
                            </td>
                            <td><?php echo Yii::$app->formatter->asCurrency($item['total_price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <table class="table">
                    <tr>
                        <td>Total Items</td>
                        <td class="text-right"><?php echo $productQuantity ?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td class="text-right">
                            <?php echo Yii::$app->formatter->asCurrency($totalPrice) ?>
                        </td>
                    </tr>
                </table>
                <script src="https://www.paypal.com/sdk/js?client-id=AYXdxwsF2ZGZPxtjnXD6nx6ydg9VHkHLQUZMrUoh7BxznCzOCVFgVOP7SO-rVnopJKUMgOAy3O1C1Osu&components=buttons"></script>

                <div id="paypal-button-container"></div>
                <script>
                    paypal.Buttons({
                        createOrder: function (data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: "20"
                                    }
                                }]
                            });
                        },
                        onApprove: function (data, actions) {
                            return actions.order.capture().then(function (details) {
                                const $form = $('#checkout-form');
                                const data = $form.serializeArray();
                                data.push({
                                    name: 'transactionId',
                                    value: details.id
                                });
                                data.push({
                                    name: 'status',
                                    value: details.status
                                });

                                $.ajax({
                                    method: 'POST',
                                    url: '<?php echo \yii\helpers\Url::to(['/cart/create-order']); ?>',
                                    data: data,
                                    success: function (res) {
                                        console.log(res);
                                        alert("Tranzacția a fost finalizată de către " + details.payer.name.given_name);
                                    }
                                });
                            });
                        }
                    }).render('#paypal-button-container');
                </script>



                <div class="paypal-button-container"></div>
                <!--                    <p class="text-right mt-3">-->
                <!--                        <button class="btn btn-secondary">Checkout</button>-->
                </p>
            </div>
        </div>
    </div>
</div>



