<form method="post" action="<?= $page->url() ?>" enctype="multipart/form-data">
    <div>
        <div>Jetzt Kontaktieren</div>
        <div class="honeypot">
            <label for="website">Website <abbr title="required">*</abbr></label>
            <input type="url" id="website" name="website" tabindex="-1">
        </div>

        <div>
            <label for="name" class="text-sm text-slate-600 block">Name*</label>
            <input required="required" type="text" id="name" value="" name="name" placeholder="Vollständiger Name">
            <?= isset($alert['name']) ? '<div class="alert error">' . esc($alert['name']) . '</div>' : '' ?>
        </div>
        <div>
            <label for="email" class="text-sm text-slate-600 block">E-Mail*</label>
            <input required="required" placeholder="E-Mail Adresse" type="email" id="email" name="email">
            <?= isset($alert['email']) ? '<div class="alert error">' . esc($alert['email']) . '</div>' : '' ?>
        </div>

        <div>
            <label for="telephone" class="text-sm text-slate-600 block">Telefon*</label>
            <input required="required" placeholder="Telefonnummer" type="tel" id="telephone" name="telephone">
        </div>

        <div>
            <label for="message" class="text-sm text-slate-600 block">Ihre Nachricht*</label>
            <textarea required="required" placeholder="Ihre Nachricht" id="message" name="message"></textarea>
        </div>

        <div class="flex gap-4 items-start">
            <input class="mt-[0.5rem]" required="required" type="checkbox" id="dsgvo" name="dsgvo">
            <label for="dsgvo">
                <small>
                    Mit dem Absenden dieses Formulars erklären Sie sich mit den Bedingungen der <a href="/datenschutz">Datenschutzrichtlinie</a> einverstanden.
                </small>
            </label>
        </div>
        <input type="submit" name="submit" value="Absenden">
    </div>

    <?php if ($kirby->session()->get('success_email') === true): ?>
        <div class="mt-2 p-5 text-sm text-green-600">
            Ihre Nachricht wurde erfolgreich abgesendet.
        </div>
    <?php endif ?>
</form>
