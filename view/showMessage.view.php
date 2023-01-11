<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => htmlspecialchars($msg["msgTitle"])
]);
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <ul>
                <p class="mt-4 break-words">
                    <?= htmlspecialchars($msg["msgContent"]); ?>
                </p>
            </ul>


        </div>
        <!-- /End replace -->

        <a href="/myMessage" class="text-blue-500 hover:underline">Back...</a>
    </div>
</main>

<?php
view_path("partials/footer.php");
?>
