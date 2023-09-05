<?php
/** @var \common\models\Order $order */

$orderAddress = $order->orderAddress
?>
<script src="https://www.paypal.com/sdk/js?client-id=AYXdxwsF2ZGZPxtjnXD6nx6ydg9VHkHLQUZMrUoh7BxznCzOCVFgVOP7SO-rVnopJKUMgOAy3O1C1Osu&components=buttons">

</script>
<h3>Order #<?php echo $order->id ?> summary: </h3>
<hr>
<div class="row">
    <div class="col">
        <h5>Account information</h5>
        <table class="table">
            <tr>
                <th>Firstname</th>
                <td><?php echo $order->firstname ?></td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td><?php echo $order->lastname ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $order->email ?></td>
            </tr>
        </table>
        <h5>Address information</h5>
        <table class="table">
            <tr>
                <th>Address</th>
                <td><?php echo $orderAddress->address ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $orderAddress->city ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $orderAddress->state ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $orderAddress->country ?></td>
            </tr>
            <tr>
                <th>ZipCode</th>
                <td><?php echo $orderAddress->zipcode ?></td>
            </tr>
        </table>
    </div>
    <div class="col">
        <h5>Products</h5>
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
            <?php foreach ($order->orderItems as $item): ?>
                <tr>
                    <td>
                        <img src="<?php echo $item->product->getImageUrl() ?>"
                             style="width: 50px;">
                    </td>
                    <td><?php echo $item->product_name ?></td>
                    <td><?php echo $item->quantity ?></td>
                    <td><?php echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Total Items</th>
                <td><?php echo $order->getItemsQuantity() ?></td>
            </tr>

            <div id="paypal-button-container"></div>
            <tr>
                <th>Total Price</th>
                <td><?php echo Yii::$app->formatter->asCurrency($order->total_price) ?></td>
            </tr>
        </table>

    </div>
</div>
<script>
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '20'
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            console.log(data, actions);
            return actions.order.capture().then(function (details) {
                console.log(details);
                const $form = $('#checkout-form');
                const formData = $form.serializeArray();
                formData.push({
                    name: 'transactionId',
                    value: details.id
                });
                formData.push({
                    name: 'orderId',
                    value: data.orderID
                });
                formData.push({
                    name: 'status',
                    value: details.status
                });
                $.ajax({
                    method: 'post',
                    url: '<?php echo \yii\helpers\Url::to(['/cart/submit-payment', 'orderId' => $order->id])?>',
                    data: formData,
                    success: function (res) {
                        alert("Thanks for your business");
                        window.location.href = '';
                    }
                })
            });
        }
    }).render('#paypal-button-container');
</script>