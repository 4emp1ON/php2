<div class="col-4">
<h2 class="page-header"><?= $title ?></h2>

<form class="d-flex flex-column ma-10" onsubmit="event.preventDefault()" METHOD="POST">
    <?= isset($good) ? '<label for="id">Id</label>' : ''?>
    <input type="text" id="id" name = 'id' <?= isset($good) ? "value=" . $good->getId() . ' disabled' : 'style="display:none"' ?> >
    <label for="name">Name</label>
    <input type="text" id="name" name = 'name' value="<?= isset($good) ? $good->getName() : '' ?>">
    <label for="info">Info</label>
    <input type="text" id="info" name = 'info' value="<?= isset($good) ? $good->getInfo() : '' ?>">
    <label for="price">Price</label>
    <input type="text" id="price" name = 'price' value="<?= isset($good) ? $good->getPrice() : '' ?>">
    <button class="btn btn-success col-6" onclick="saveData()">Сохранить</button>
</form>
    <div id="msg" class="badge badge-primary text-wrap" style="width: 12rem;"></div>
</div>

<script>
    function saveData() {
        const id = document.getElementById('id').value;
        const name = document.getElementById('name').value;
        const info = document.getElementById('info').value;
        const price = document.getElementById('price').value;


        if (!id) {
            fetch(`/?a=fetchEdit&name=${name}&info=${info}&price=${price}`, {method: 'POST'})
                .then(response => console.log(response.json()
                    .then(data => {
                        const el = document.querySelector('#msg');
                        el.innerText = 'Товар удачно сохранен';

                        setTimeout(clearMessage, 2000);
                    })));
        } else {
            fetch(`/?a=fetchEdit&id=${id}&name=${name}&info=${info}&price=${price}`, {method: 'POST'})
                .then(response => console.log(response.json()
                .then(data => {
                    const el = document.querySelector('#msg');
                    el.innerText = 'Товар удачно сохранен';

                    setTimeout(clearMessage, 2000);
                })));
        }

    function clearMessage() {
        document.querySelector('#msg').innerHTML = '';
    }
    }
</script>