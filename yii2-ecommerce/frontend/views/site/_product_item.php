<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 11:53 AM
 */
/** @var \common\models\Product $model */
?>
<div class="card h-100">
    <img class="card-img-top" src="https://dummyimage.com/550x400/dee2e6/6c757d.jpg" alt="..."/>
    <div class="card-body">
        <h5 class="card-title">
            <a href="#" class="text-dark"><?php echo \yii\helpers\StringHelper::truncateWords($model->name, 20) ?></a>
        </h5>
        <h5><?php echo Yii::$app->formatter->asCurrency($model->price) ?></h5>
        <div class="card-text">
            <?php echo $model->getShortDescription() ?>
        </div>
    </div>
    <div class="card-footer text-right">
        <a href="<?php echo \yii\helpers\Url::to(['/cart/adda']) ?>" class="btn btn-primary btn-add-to-cart">
            Add to Cart
        </a>
    </div>
</div>