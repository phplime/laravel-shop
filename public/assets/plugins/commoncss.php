<?php header("Content-type: text/css; charset: UTF-8");?>

.flex {
    display: flex;
}

.flex-row {
    flex-direction: row!important;
}

.flex-column {
    flex-direction: column!important;
}

.space-between {
    display: flex;
    justify-content: space-between!important;
}

.space-around {
    display: flex;
    justify-content: space-around!important;
}
.flex-row-reverse{
    flex-direction: row-reverse!important;
}
.align-center {
    display: flex;
    align-items: center!important;
}
.centerCard{
    display:flex;
    align-items: center;
    justify-content: center;
    min-height: 65dvh;
}
.flex-1 {
    flex: 1;
}

.flex-0 {
    flex: 0;
}

<?php for ($i =0; $i < 100; $i++) {
    ?>.pt-<?=$i;

    ?> {
        padding-top: <?=$i;
        ?>px !important;
    }

    .pb-<?=$i;

    ?> {
        padding-bottom: <?=$i;
        ?>px !important;
    }


    .pt-<?=$i;

        ?>rm {
            padding-top: <?=$i;
            ?>rem !important;
        }

        .pb-<?=$i;

        ?>rm {
            padding-bottom: <?=$i;
            ?>rem !important;
        }

    .pl-<?=$i;

    ?> {
        padding-left: <?=$i;
        ?>px !important;
    }

    .pr-<?=$i;

    ?> {
        padding-right: <?=$i;
        ?>px !important;
    }

    .mt-<?=$i;

    ?> {
        margin-top: <?=$i;
        ?>px !important;
    }

    .mb-<?=$i;

    ?> {
        margin-bottom: <?=$i;
        ?>px !important;
    }

    .mt-<?=$i;

    ?>rm {
        margin-top: <?=$i;
        ?>rem !important;
    }

    .mb-<?=$i;

    ?>rm {
        margin-bottom: <?=$i;
        ?>rem !important;
    }

    .ml-<?=$i;

    ?> {
        margin-left: <?=$i;
        ?>px !important;
    }

    .mr-<?=$i;

    ?> {
        margin-right: <?=$i;
        ?>px !important;
    }

    .p-<?=$i;

    ?> {
        padding: <?=$i;
        ?>px !important;
    }

    .m-<?=$i;

    ?> {
        margin: <?=$i;
        ?>px !important;
    }


     .my-<?=$i;

    ?>rm {
        margin-top: <?=$i;
        ?>rem !important;
        margin-bottom: <?=$i;
        ?>rem !important;
    }

    .mx-<?=$i;

    ?>rm {
        margin-left: <?=$i;
        ?>rem !important;
        margin-right: <?=$i;
        ?>rem !important;
    }

    .fz-<?=$i;

    ?> {
        font-size: <?=$i;
        ?>px !important;
    }

    .fz-<?=$i;

    ?>rm {
        font-size: <?=$i;
        ?>rem !important;
    }

    .ht-<?=$i;

    ?> {
        height: <?=$i;
        ?>px !important;
    }

    

    .p-<?= $i?>rm{
        padding: <?= $i;?>rem!important;
    }

    .py-<?=$i;

    ?> {
        padding-top: <?=$i;
        ?>px !important;
        padding-bottom: <?=$i;
        ?>px !important;
    }

    .px-<?=$i;

    ?> {
        padding-left: <?=$i;
        ?>px !important;
        padding-right: <?=$i;
        ?>px !important;
    }  
    
    
    .py-<?=$i;

    ?>rm {
        padding-top: <?=$i;
        ?>rem !important;
        padding-bottom: <?=$i;
        ?>rem !important;
    }

    .px-<?=$i;

    ?>rm {
        padding-left: <?=$i;
        ?>rem !important;
        padding-right: <?=$i;
        ?>rem !important;
    }

    .gap-<?=$i;

    ?> {
        gap: <?=$i;
        ?>px !important;
    }

    .gap-<?=$i;

    ?>rm {
        gap: <?=$i;
        ?>rem !important;
    }
    .bb-solid-<?= $i;?>{
        border-bottom: 1px solid;
    }
    
    .bt-solid-<?= $i;?>{
        border-top: 1px solid;
    } 
    .bt-dashed-<?= $i;?>{
        border-top: 1px dashed;
    }
    .bb-dashed-<?= $i;?>{
        border-bottom: 1px dashed;
    }

    <?php
}

?>


<?php for ($i = 0; $i < 500; $i++): ?>
.wd-<?= $i ?> { width: <?= $i ?>px !important; }
.wd-<?= $i ?>rm { width: <?= $i ?>rem !important; }
.ht-<?= $i ?>rm { height: <?= $i ?>rem !important; }
.min-w-<?= $i ?> { min-width: <?= $i ?>px !important; }
.max-w-<?= $i ?> { max-width: <?= $i ?>px !important; }
.min-w-<?= $i ?>rm { min-width: <?= $i ?>rem !important; }
.max-w-<?= $i ?>rm { max-width: <?= $i ?>rem !important; }
<?php endfor; ?>