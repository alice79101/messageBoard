<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "確定刪除此則訊息嗎？"
]);
?>

    <main>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <?php
                if (!isset($_SESSION["memberID"])) { ?>
                <a href="/login" class="text-blue-500 inline-block hover:border-b border-blue-900">請先登入</a>
                <?php } elseif($_SERVER["REQUEST_METHOD"] === "GET" && $deleteStatus === "NO") {
//                    $_SESSION["memberID"] !== $msg["memberID"])
                    ?>
                    <form action="#" method="POST">
                        <div class="py-2 inline-block w-screen min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="table-fixed">
                                    <thead class="bg-white border-b">
                                    <tr>
                                        <th class="w-1/4 text-sm font-medium text-gray-900 px-6 py-4 text-medium">標題
                                        </th>
                                        <th class="w-3/4 text-sm font-medium text-gray-900 px-6 py-4 text-medium">內容
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="bg-gray-100 border-b">
                                        <td class="w-1/4 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($msg["msgTitle"]); ?></td>
                                        <td class="w-3/4 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?php
                                            echo "<pre>";
                                            echo htmlspecialchars($msg["msgContent"]);
                                            echo "</pre>"; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <button type="submit"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        確認刪除
                                    </button>
                                </div>

                                <a href="/msg?msgIndex=<?= $_GET['msgIndex'] ?>"
                                   class="px-4 text-blue-500 hover:underline">Back...</a>
                            </div>
                        </div>
                    </form>
                <?php } elseif($deleteStatus === "YES") { ?>
                    <br>
                    <a href="/myMessage" class="px-4 text-blue-500 hover:underline">訊息已刪除，點我回到 My Message</a>
                <?php } ?>
            </div>
            <br>
        </div>
    </main>


<?php
view_path("partials/footer.php");
?>