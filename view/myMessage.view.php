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
                    <a href="/msg?msgIndex=<?=$value['msgIndex'] ?>" class="text-gray-500 hover:underline">
                        <?= htmlspecialchars($value['msgTitle']) //顯示的文字為訊息標題?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="px-4 py-6 sm:px-0">
                    <a href="/createMessage" class="text-blue-500 hover:underline">Leave a Message...</a>
                </div>
            </ul>
        </div>
        <!-- /End replace -->

    </div>
</main>