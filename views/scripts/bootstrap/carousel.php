<div class="row">
    <?php if ($this->editmode) { ?>
        <label>Slides:</label>
        <?php
        echo $this->numeric("slides", array("reload" => true));

        $store = array(
            array("carousel-indicators-ll", "Orange"),
            array("carousel-indicators-light", "Weiß")
        );

        if ($this->select("class")->isEmpty()) {
            $this->select("class")->setDataFromResource($store[0][0]);
        }

        echo $this->select("class", array("reload" => true, "store" => $store));


        ?>


    <?php }

    $class = $this->select("class")->getData();
    ?>

    <?php

    $slides = $this->numeric("slides")->getData();

    if (!$slides)
        $slides = 1;

    $randomid = "caoursel-" . rand();
    ?>

    <div id="<?= $randomid ?>" <?php echo $this->editmode ? '' : 'class="carousel slide carousel-fade" data-ride="carousel" data-interval="6500"' ?>>
        <!-- Indicators -->
        <ol class="carousel-indicators <?= $class ?>">
            <?php for ($i = 0; $i < $slides; $i++) { ?>
                <li data-target="#<?= $randomid ?>" data-slide-to="<?= $i ?>"
                    class="<?= $i == 0 ? "active" : "" ?>"></li>
            <?php } ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="<?= $this->editmode ? "" : "carousel-inner" ?>">
            <?php for ($i = 0; $i < $slides; $i++) { ?>
                <div class="item clearfix <?= $i == 0 ? "active" : "" ?>">
                    <?php if ($this->editmode) { ?>
                        <h2>Slide <?= ($i + 1) ?></h2>
                    <?php } ?>
                    <?= $this->template("helper/areablock.php", array("name" => "s-" . $i, "params" => array("image" => array("class" => "pull-right")))); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
