<form method="post" action="<?= $page->url() ?>" enctype="multipart/form-data">
    <div>
        <div>
            Bewerben Sie sich für diese Stelle
        </div>
        <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="url" id="website" name="website" tabindex="-1">
        </div>

        <div>
            <label for="name" class="text-sm text-slate-600 block">Name*</label>
            <input required="required" type="text" id="name" value="" name="name" placeholder="Vollständiger Name">
            <?= isset($alerts['name']) ? '<span>' . esc($alerts['name']) . '</span>' : '' ?>
        </div>
        <div>
            <label for="email" class="text-sm text-slate-600 block">E-Mail*</label>
            <input required="required" placeholder="E-Mail Adresse" type="email" id="email" name="email">
            <?= isset($alerts['email']) ? '<span>' . esc($alerts['email']) . '</span>' : '' ?>
        </div>

        <input type="hidden" name="reference" value="<?= $page->title() ?>">

        <div>
            <label for="telephone" class="text-sm text-slate-600 block">Telefon*</label>
            <input required="required" placeholder="Telefonnummer" type="tel" id="telephone" name="telephone">
        </div>

        <div>
            <label>Lebenslauf*</label>
            <label for="cv" class="text-sm text-slate-600 p-4 custom-upload flex justify-between items-center">Lebenslauf hochladen <div class="max-w-[2rem] svg-100"><?= svg('assets/branding/file.svg') ?></div></label>
            <input hidden accept="application/pdf" type="file" id="cv" name="cv">
        </div>

        <div>
            <label class="text-sm text-slate-600 flex">Weiteres Dokument</label>
            <label for="document" class="text-sm text-slate-600 p-4 custom-upload flex justify-between items-center">ein weiteres Dokument hochladen <div class="max-w-[2rem] svg-100"><?= svg('assets/branding/file.svg') ?></div></label>
            <input hidden accept="application/pdf" type="file" id="document" name="document">
        </div>

        <?= isset($alerts['file']) ? '<span>' . esc($alerts['file']) . '</span>' : '' ?>

        <div class="flex gap-4 items-start">
            <input required="required" type="checkbox" id="dsgvo" name="dsgvo">
            <label for="dsgvo">
                <small>
                    Mit dem Absenden dieses Formulars erklären Sie sich mit den Bedingungen der <a href="/datenschutz">Datenschutzrichtlinie</a> einverstanden.
                </small>
            </label>
        </div>
        <input type="submit" name="submit" value="Absenden">
    </div>
</form>
<div id="scroller"></div>

<?php if(isset($alerts)): ?>
<script>
let scrollDiv = document.querySelector('.scroller');
console.log(scrollDiv);
scrollDiv.scrollIntoView({behavior: "smooth", block: "end"});
</script>
<?php endif ?>
