<div class="sidebar-modal <?= !empty($data['class']) ? $data['class'] . 'Sidebar' : '' ?>">
    <div class="heading"><?= $data['title'] ?? '' ?></div>
    <div class="sidebar-content">
        <form method="<?= $data['method'] ?? 'POST' ?>" action="<?= $data['url'] ?>" onsubmit="formSubmit(event,this)">
            @csrf
            <div class="sidebar-wrapper">
                <div class="sidebar-body">
