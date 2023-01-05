<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p>
                click to read content or manage it.
            </p>
            <ul>
                <?php foreach ($myMsg as $k=>$value) : ?>
                <div>
                    <a href="/msg?msgIndex=<?=$value['msgIndex'] ?>" class="text-gray-500 hover:underline"">
                        <?= htmlspecialchars($value['msgTitle'])?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </ul>
        </div>
        <!-- /End replace -->

    </div>
</main>