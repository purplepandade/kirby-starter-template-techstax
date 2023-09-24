<!DOCTYPE html>
<html lang="de">
<?php snippet('html-head') ?>

<body class="overflow-x-hidden font-karla bg-bodyBG m">
    <?php snippet('header-top') ?>

    <main>
        <section data-type="herofull">
            <div class="w-full h-[90vh] relative">

                <?php if ($image = $page->main_image()->toFile()): ?>
                    <img alt="<?= $image->alt() ?>" class="h-full w-full object-cover absolute top-0 left-0 right-0"
                        src="<?= $image->url() ?>" height="<?= $image->height() ?>" width="<?= $image->width() ?>">
                <?php endif ?>

                <div class="h-full flex relative justify-end flex-col items-center text-white w-full">
                    <div class="h-[100%] flex flex-col justify-center">

                        <div class="page-width my-auto justify-self-end pb-12 block md:grid grid-cols-1">
                            <div class="text-4xl md:text-6xl font-semibold text-white max-w-5xl md:pr-12">
                                Zu unseren unbestrittenen Stärken zählen alle Arbeiten in den Bereichen
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <?php
        $flickity = (object) [
            'wrapAround' => true,
            'prevNextButtons' => false,
            'adaptiveHeight' => true,
            'pageDots' => true,
            'imagesLoaded' => true,
            'lazyLoad' => true,
            'contain' => true
        ];
        ?>
        <section data-section-type="leistungen" class="page-width">
            <div class="w-full" data-flickity-config='<?= json_encode($flickity) ?>'>
                <?php $leistungen = page('leistungen')->columns()->toStructure() ?>
                <?php $count = 0 ?>
                <?php foreach ($leistungen as $leistung): ?>
                    <div class="w-full">
                        <div class="w-full py-8 relative">
                        <?php if (!$leistung->icon()->isEmpty()): ?>
                                <div data-mobile
                                    class="p-4 items-center justify-center bg-primary svg-100 animated w-[4rem] h-[4rem] fill-white rounded-full top-12 right-8 md:hidden md:top-8 leistungsicon hidden">
                                    <?= svg($leistung->icon()->toFile()) ?>
                                </div>
                            <?php endif ?>
                            <div class="block md:inline-block w-full md:w-[40%] mb-4">
                                <img class="w-full" src="<?= $leistung->image()->toFile()->url() ?>">
                                <div class="w-full hidden md:flex justify-between py-4">
                                    <div data-slide-prev class="btn link-arrow-reverse"></div>
                                    <div data-slide-next class="btn link-arrow"></div>
                                </div>
                            </div><div class="block md:inline-block md:px-8 w-full md:w-[60%] align-top relative">
                            <?php if (!$leistung->icon()->isEmpty()): ?>
                                <div data-desktop
                                    class="p-4 items-center justify-center bg-primary svg-100 animated w-[4rem] h-[4rem] fill-white rounded-full top-12 right-8 absolute md:right-2 md:top-8 leistungsicon hidden">
                                    <?= svg($leistung->icon()->toFile()) ?>
                                </div>
                            <?php endif ?>
                                <div class="text-2xl font-semibold mb-4">
                                    <?= $leistung->name() ?>
                                </div>
                                <div class="text-lg mb-8 md:max-w-[90%]">
                                    <?= $leistung->intro() ?>
                                </div>
                                <div class="h-1 bg-black opacity-50 mb-8"></div>

                                <ul class="grid grid-cols-1 gap-2 md:gap-5 md:grid-cols-2 py-4 custom-list">
                                    <?php foreach ($leistung->examples()->split() as $example): ?>
                                        <li>
                                            <?= $example ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>

                                <div class="text-lg opacity-50">
                                    <?= $leistung->text() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $count++ ?>

                <?php endforeach ?>
            </div>
            <div class="w-full flex md:hidden justify-between py-4">
                <div data-slide-prev class="btn link-arrow-reverse"></div>
                <div data-slide-next class="btn link-arrow"></div>
            </div>
        </section>

        <?php snippet('certificates') ?>


    </main>

    <?php snippet('footer') ?>

</body>

</html>