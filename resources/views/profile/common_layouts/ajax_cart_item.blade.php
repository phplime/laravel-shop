@php
$itemUrl = url('cart/' . $item['id']);
$qtyMinus = $item['quantity'] - 1;
$qtyPlus = $item['quantity'] + 1;
$thumb = !empty($item['product']['thumb']) ? __image($item['product']['thumb']) : 'https://placehold.co/80x80/1a1a2e/ffffff?text=%F0%9F%8D%BD';
@endphp

<div class="cart-row" data-cart-id="<?= $item['id'] ?>">
    <img src="<?= $thumb ?>" alt="<?= $item['product']['name'] ?? 'Item' ?>">
    <div class="cri">
        <h6><?= $item['product']['name'] ?? 'Item' ?></h6>
        <div class="cp"><?= __currency_position($item['price']) ?></div>
        @if (!empty($item['vendor']['app_name']))
        <div class="ck"><i class="bi bi-shop me-1"></i><?= $item['vendor']['app_name'] ?></div>
        @endif
    </div>
    <div class="cqty">
        @if($item['quantity'] > 1)
        <button class="cq-btn" onclick="cartAction('PATCH', '<?= $itemUrl ?>', {quantity: <?= $qtyMinus ?> })">−</button>
        @else
        <button class="cq-btn" onclick="cartAction('DELETE', '<?= $itemUrl ?>')"><i class="bi bi-trash"></i></button>
        @endif

        <input type="number" value="<?= $item['quantity'] ?>" readonly class="qty-input">

        <button class="cq-btn" onclick="cartAction('PATCH', '<?= $itemUrl ?>', {quantity: <?= $qtyPlus ?> })">+</button>
    </div>
</div>