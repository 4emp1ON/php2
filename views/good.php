<?php /**@var \App\models\Good $good */?>

<h2 class="page-header">Описание товара:</h2>

<div class="good-layout media position-relative">
    <img src="https://via.placeholder.com/144x144" class="mr-3" alt="<?= $good->getName() ?>">
    <div class="media-body">
        <h5 class="mt-0"><?= $good->getName() ?></h5>
        <p><?= $good->getInfo() ?></p>
        <a href="#"><button type="button" class="btn btn-success">Купить</button>
        </a>
        <a href="/?a=edit&id=<?= $good->getId() ?>"><button type="button" class="btn btn-secondary">Изменить</button>
        </a>
    </div>
</div>
