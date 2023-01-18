<?php
view_path("partials/head.php");
view_path("partials/nav.php");

view_path("partials/banner.php", [
    'heading' => "Home"
]);
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p>
                Welcome!<br><br>
                <li>請於右上角註冊會員並登入，方能享用各項功能。</li>
                <li>可新增、修改、刪除自身的留言。</li>
                <li>可於 What's new 看到最新十則的訊息，但僅有權限的人才能看內容。</li>
<!--                --><?php //dumpAndDie($_SESSION); ?>
            </p>
        </div>
        <!-- /End replace -->

    </div>
</main>

<?php
view_path("partials/footer.php");
?>