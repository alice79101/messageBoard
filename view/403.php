<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
        'heading' => '403 FORBIDDEN'
]);

?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">

            <p class="mt-4 text-red-500">權限不足，無法查看。<br>請先登入或確認您的帳號。</p>
        </div>

        <a href="/" class="text-blue-500 hover:underline">Go back home...</a>
        <!-- /End replace -->

    </div>
</main>
<?php
view_path("partials/footer.php");
