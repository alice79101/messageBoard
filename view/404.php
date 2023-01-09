<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => '404 NOT FOUND'
]);
?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">

            <p class="mt-4">Oops! you have wrong link.</p>
        </div>

        <a href="/" class="text-blue-500 hover:underline">Go back home...</a>
        <!-- /End replace -->

    </div>
</main>
<?php
view_path("partials/footer.php");
