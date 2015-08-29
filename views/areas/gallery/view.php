<?php

$childs = array();

foreach ($this->multihref("images")->getElements() as $element) {
    if ($element instanceof Asset_Image) {
        $childs[] = $element;
    } else if ($element instanceof Asset_Folder) {
        foreach ($element->getChilds() as $child) {
            if ($child instanceof Asset_Image)
                $childs[] = $child;
        }
    }
}

$this->rel = "gallery-" . uniqid();

$type = $this->select("type")->getData();
$type = $type ? intval($type) : 4;

$rows = array_chunk($childs, 12 / $type);
?>


<?php foreach ($rows as $childs) { ?>
    <div class="row">
        <?php foreach ($childs as $asset) { ?>
            <div class="col-xs-12 col-sm-<?= $type ?> col-gallery">
                <div class="image">
                    <a href="<?= $asset->getThumbnail("lightboxImage") ?>" class="fancybox" rel="<?= $this->rel ?>"
                       title="<?= $asset->getProperty("lightbox_text") ?>">
                        <img src="<?= $asset->getThumbnail("galleryThumbnail-" . $type) ?>" class="img-responsive"/>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
