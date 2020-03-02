<?php
/**@var \App\models\Good[] $goods */
/**@var string $title */
?>

<h2 class="d-flex justify-content-center"><?= $title ?></h2>
<div class="goods-layout container d-flex flex-row flex-wrap justify-content-around">
    <?php foreach ($goods as $good) : ?>
        <div class="card-position card" style="width: 18rem;">
            <img src="https://via.placeholder.com/286x180" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $good->getName() ?></h5>
                <p class="card-text"><?= $good->getInfo() ?></p>
                <a href="?a=one&id=<?= $good->getId()?>" class="btn btn-primary">Подробнее</a>
            </div>
        </div>
    <?php endforeach;?>
</div>
